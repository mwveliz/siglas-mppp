<?php

class cronGpsTrackTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'gps';
    $this->name             = 'cronTrack';
    $this->briefDescription = 'Recupera los sms recibidos por gammu desde los dispositivos gps para guardarlos en DB SIGLAS';
    $this->detailedDescription = '';
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    
    if(file_exists(sfConfig::get("sf_root_dir")."/config/siglas/gps.yml")) {
        $gps_conf = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/gps.yml");
        
        if($gps_conf['recuperacion']['status']) {
            $ultimo_status_completo= $gps_conf['recuperacion']['ultimo_status'];
            $actual= strtotime(date('Y-m-d H:i:s'));
            $ultima= strtotime($ultimo_status_completo);

            $actual= strtotime('-20 second ' . date('Y-m-d H:i:s', $actual));

            if($ultima > $actual) {
                ////////////////
                //INICIO DE PROCESO DE RECUPERACION DE TRACKS POR LAPSOS CORTOS DE TIEMPOS
                ////////////////
                $gps_activos= Doctrine::getTable('Vehiculos_GpsVehiculo')->findByStatus('A');
    
                //SI EXISTEN GPS ACTIVOS INSTALADOS EN VEHICULOS
                $sims= ''; $simok= FALSE;
                if(count($gps_activos) > 0) {
                    //ARMA ARRAY PARA QUERY DBLINK
                    foreach($gps_activos as $gps_activo) {
                        //AGREGA EL 0 CORRESPONDIENTE AL CODIGO DE AREA EN CASO DE NO TENERLO
                        if(substr($gps_activo->getSim(), 1) != 0)
                            $sims .= "'0";
                        else
                            $sims .= "'";
                        $sims .= $gps_activo->getSim()."',";
                        $simok= TRUE;
                    }
                    $sims .= "end";
                    $sims= str_replace(",end", "", $sims);

                    //SI LOS GPS ACTIVOS POSEEN NUMEROS SIM
                    if($simok) {
                        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");
                        
                        $parametro= explode('#', $gps_conf['recuperacion']['frecuencia_activo']);
                        $parametro_uno= $parametro[0];
                        $parametro_dos= $parametro[1];
                        
                        switch ($parametro_dos) {
                            case 's':
                                $parametro_dos= ' SECOND';
                                break;
                            case 'm':
                                $parametro_dos= ' MINUTE';
                                break;
                            case 'h':
                                $parametro_dos= ' HOUR';
                                break;
                        }
                        
                        $frecuencia= $parametro_uno.$parametro_dos;
                        
                        $query = '';
                        if($sf_sms['conexion_gammu']['version']=='1.28')
                            $query = "SELECT * FROM inbox WHERE sendernumber IN (". $sims .") AND (NOW() - INTERVAL '". $frecuencia ."') < updateindb";
                        elseif($sf_sms['conexion_gammu']['version']=='1.31')
                            $query = "SELECT * FROM inbox WHERE SenderNumber IN (". $sims .") AND (NOW() - INTERVAL '". $frecuencia ."') < UpdatedInDB";
                    }

                    $manager = Doctrine_Manager::getInstance()
                                        ->openConnection(
                                        'pgsql' . '://' .
                                        $sf_sms['conexion_gammu']['username'] . ':' .
                                        $sf_sms['conexion_gammu']['password'] . '@' .
                                        $sf_sms['conexion_gammu']['host'] . '/' .
                                        $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

                    $inbox = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                    Doctrine_Manager::getInstance()->closeConnection($manager);

            //        foreach($inbox as $val) {
            //            echo $val['TextDecoded'].' |||||||||||||||||| ';
            //        }
            //        exit;

            //        $texto= 'lat:10.446965
            //long:-66.786662
            //speed:3.96 
            //T:13/12/07 06:59
            //http://maps.google.com/maps?f=q&q=10.446965,-66.786662&z=16
            //Pwr: OFF Door: OFF ACC: OFF';

                    //ER PARA COORDENADAS (lat & lon)
                    $patron_coord = '(lat:-?[0-9][0-9]?[\.,]?[0-9]{1,})|(long:-?[0-9][0-9]?[\.,]?[0-9]{1,})';
                    //ER PARA VELOCIDAD (speed)
                    $patron_vel = '(speed:[0-9]{1,3}[\.,]?[0-9][0-9]?)';
                    //ER PARA FECHA DE TRASMISION (T)
                    $patron_tras = '(T:[0-9]{1,2}(-|\/)[0-9]{1,2}(-|\/)[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2})';
                    //ER PARA ENLACE GOOGLE MAPS
                    $patron_link = '(http:\/\/.{5,}z=16)';
                    //ER PARA BATERIA CONECTADA (Pwr)
                    $patron_prw = '(Pwr:\sO(N|FF))';
                    //ER PARA PUERTAS ABIERTAS (Door)
                    $patron_door = '(Door:\sO(N|FF))';
                    //ER PARA VEHICULO ENCENDIDO (ACC)
                    $patron_acc = '(ACC:\sO(N|FF))';


            //        $main_patron= '/'.$patron_coord.'|'.$patron_vel.'|'.$patron_tras.'|'.$patron_link.'|'.$patron_prw.'|'.$patron_door.'|'.$patron_acc.'/';
            //
            //        $coincidencias= NULL;
            //        $encontrado = preg_match_all($main_patron, $texto, $coincidencias, PREG_OFFSET_CAPTURE);
            //               
            //        
            //        print_r($coincidencias); exit;

                    foreach($inbox as $sms) {

                        //MERGE DE PRATRONES ER
                        $main_patron= '/'.$patron_coord.'|'.$patron_vel.'|'.$patron_tras.'|'.$patron_link.'|'.$patron_prw.'|'.$patron_door.'|'.$patron_acc.'/';

                        $coincidencias= NULL;
                        $encontrado = preg_match_all($main_patron, $sms['TextDecoded'], $coincidencias, PREG_OFFSET_CAPTURE);
                        
                        $del_array= array();
                        //SOLO SI SE TRATA DE SMS DE TRACKING
                        if(count($coincidencias[0])== 8) {
                            $vehiculo= Doctrine::getTable('Vehiculos_GpsVehiculo')->findOneBySim($sms['SenderNumber']);
                            
                            if(count($vehiculo) > 0) {
                                //DATOS CAPTURADOS POR PATRONES ER
                                $latitud= $coincidencias[0][0][0];
                                $longitud= $coincidencias[0][1][0];
                                $speed= $coincidencias[0][2][0];
                                $enlace= $coincidencias[0][4][0];
                                $pwr= $coincidencias[0][5][0];
                                $door= $coincidencias[0][6][0];
                                $acc= $coincidencias[0][7][0];

                                $vehiculos_tracker = new Vehiculos_Tracker();
                                $vehiculos_tracker->setGpsVehiculoId($vehiculo->getVehiculoId());
                                $vehiculos_tracker->setLatitud(str_replace('lat:', '', $latitud));
                                $vehiculos_tracker->setLongitud(str_replace('long:', '', $longitud));
                                $vehiculos_tracker->setVelocidad(str_replace('speed:', '', $speed));
                                $vehiculos_tracker->setEnlace(str_replace('enlace:', '', $enlace));
                                $vehiculos_tracker->setFuente(str_replace('Pwr:', '', $pwr));
                                $vehiculos_tracker->setPuerta(str_replace('Door:', '', $door));
                                $vehiculos_tracker->setAcc(str_replace('ACC:', '', $acc));
                                $vehiculos_tracker->setFRecibido($sms['UpdatedInDB']);
                                $vehiculos_tracker->setIdUpdate(1);
                                $vehiculos_tracker->setIdCreate(1);
                                $vehiculos_tracker->setIpUpdate('127.1.1.1');
                                $vehiculos_tracker->setIpCreate('127.1.1.1');

                                $vehiculos_tracker->save();
                                
                                if($sf_sms['conexion_gammu']['version']=='1.28')
                                    $del_array[]= $sms['Id'];
                                elseif($sf_sms['conexion_gammu']['version']=='1.31')
                                    $del_array[]= $sms['ID'];
                            }
                        }
                    }
                    
                    //BORRA TODOS LOS TRACKS REGISTRADOS EN SIGLAS EXTRAIDOS DE GAMMU POR ID DE ESTE ULTIMO
                    $ids= "";
                    foreach($del_array as $val)
                        $ids .= "'".$val."',";
                    $ids .= 'end';
                    $ids= str_replace(',end', '', $ids);
                    
                    if($ids != 'end') {
                        if($sf_sms['conexion_gammu']['version']=='1.28')
                            $query = "DELETE FROM inbox WHERE Id IN (".$ids.")";
                        elseif($sf_sms['conexion_gammu']['version']=='1.31')
                            $query = "DELETE FROM inbox WHERE ID IN (".$ids.")";

                        $manager = Doctrine_Manager::getInstance()
                                            ->openConnection(
                                            'pgsql' . '://' .
                                            $sf_sms['conexion_gammu']['username'] . ':' .
                                            $sf_sms['conexion_gammu']['password'] . '@' .
                                            $sf_sms['conexion_gammu']['host'] . '/' .
                                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

                        $delete_inbox = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                        Doctrine_Manager::getInstance()->closeConnection($manager);
                    }
                    
            //        print_r($coincidencias); exit;
            //        
            //        echo $encontrado; exit;
            //        
            //        if ($encontrado) {
            //            print "<pre>"; print_r($coincidencias); print "</pre>\n";
            //            print "<p>Se han encontrado $encontrado coincidencias.</p>\n";
            //            foreach ($coincidencias[0] as $coincide) {
            //                print "<p>Cadena: '$coincide[0]' - Posición: $coincide[1]</p>\n";
            //            }
            //        } else {
            //            print "<p>No se han encontrado coincidencias.</p>\n";
            //        }


                }
                ////////////////
                //FIN DE PROCESO DE RECUPERACION
                ////////////////
            }else {
                $gps_conf['recuperacion']['status']= FALSE;

                $cadena = sfYAML::dump($gps_conf);

                file_put_contents(sfConfig::get("sf_root_dir").'/config/siglas/gps.yml', $cadena);
            }
        }
    }else {
        echo 'EL ARCHIVO DE CONFIGURACION DE GPS TRACKER NO EXISTE. CREELO Y REINTENTE';
    }
  }
}