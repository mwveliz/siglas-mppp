<?php

class cronGpsAlertTask extends sfBaseTask
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
    $this->name             = 'cronGpsAlert';
    $this->briefDescription = '';
    $this->detailedDescription = 'CRON PARA SER EJECUTADO AL MOMENTO DE GENERAR REPORTES Y A MEDIA NOCHE, RECUPERA TODOS LOS SMS DE GAMMU QUE SEAN ALERTAS GPS DE TODOS LOS VEHICULOS ACTIVOS EN SIGLAS';
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    if(file_exists(sfConfig::get("sf_root_dir")."/config/siglas/gps.yml")) {
        $gps_conf = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/gps.yml");
        
        if($gps_conf['activo']) {
            if($gps_conf['alertas']['status']) {
                ////////////////
                //INICIO DE PROCESO DE RECUPERACION DE TRACKS POR LAPSOS LARGOS DE TIEMPOS
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

                        $query = '';
                        if($sf_sms['conexion_gammu']['version']=='1.28')
                            $query = "SELECT * FROM inbox WHERE sendernumber IN (". $sims .")";
                        elseif($sf_sms['conexion_gammu']['version']=='1.31')
                            $query = "SELECT * FROM inbox WHERE SenderNumber IN (". $sims .")";

                        $manager = Doctrine_Manager::getInstance()
                                            ->openConnection(
                                            'pgsql' . '://' .
                                            $sf_sms['conexion_gammu']['username'] . ':' .
                                            $sf_sms['conexion_gammu']['password'] . '@' .
                                            $sf_sms['conexion_gammu']['host'] . '/' .
                                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

                        $inbox = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                        Doctrine_Manager::getInstance()->closeConnection($manager);

                        //COMANDO
                        //gpssignal
                        $patron_comm1 = '(no[[:space:]]gps[!]?)';
                        //move
                        $patron_comm2 = '(move[!]?)';
                        //lowbattery
                        $patron_comm3 = '(lowbattery[!]?)';
                        //extpower
                        $patron_comm4 = '(extpower[!]?)';
                        //acc
                        $patron_comm5 = '(ACC[[:space:]]o(n|ff)[!]?)';
                        //speed
                        $patron_comm6 = '(speed[0-9]{1,4}[!]?)';
                        //AGREGAR AQUI MAS COMANDOS..
                        
                        //ANIDACION DE ER PARA COMANDOS
                        $patron_comm= '('.$patron_comm1.'|'.$patron_comm2.'|'.$patron_comm3.'|'.$patron_comm4.'|'.$patron_comm5.'|'.$patron_comm6.')';
                        
                        //ER PARA COORDENADAS (lat & lon)
                        $patron_coord = '(lat:-?[0-9][0-9]?[\.,]?[0-9]{1,})|(long:-?[0-9][0-9]?[\.,]?[0-9]{1,})';
                        //ER PARA VELOCIDAD (speed)
                        $patron_vel = '(speed:[0-9]{1,3}[\.,]?[0-9][0-9]?)';
                        //ER PARA FECHA DE TRASMISION (T)
                        $patron_tras = '(T:[0-9]{1,2}(-|\/)[0-9]{1,2}(-|\/)[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2})';
                        //ER PARA ENLACE GOOGLE MAPS
                        $patron_link = '(http:\/\/.{5,}z=16)';

                        $del_array= array();
                        foreach($inbox as $sms) {
                            //MERGE DE PRATRONES ER
                            $main_patron= '/'.$patron_comm.'|'.$patron_coord.'|'.$patron_vel.'|'.$patron_tras.'|'.$patron_link.'/';
//                            $main_patron= '/'.$pa.'/';

                            $coincidencias= NULL;
                            $encontrado = preg_match_all($main_patron, $sms['TextDecoded'], $coincidencias, PREG_OFFSET_CAPTURE);

                            //SOLO SI SE TRATA DE SMS DE TRACKING
                            if(count($coincidencias[0])== 6) {
                                $vehiculo= Doctrine::getTable('Vehiculos_GpsVehiculo')->findOneBySim($sms['SenderNumber']);
                                
                                if(count($vehiculo) > 0) {
                                    //DATOS CAPTURADOS POR PATRONES ER
                                    $comando= $coincidencias[0][0][0];
                                    $latitud= $coincidencias[0][1][0];
                                    $longitud= $coincidencias[0][2][0];
                                    $speed= $coincidencias[0][3][0];
                                    $time= $coincidencias[0][4][0];
                                    $enlace= $coincidencias[0][5][0];
                                    
                                    $time= str_replace('T:', '', $time);
                                    list($fecha, $hora)= explode(' ', $time);
                                    $fecha_parts= explode('/', $fecha);
                                    $new_time= $fecha_parts[0].'-'.$fecha_parts[1].'-'.$fecha_parts[2];
                                    $new_time.= ' '.$hora;
                                    
                                    $vehiculos_alerta = new Vehiculos_GpsVehiculoAlerta();
                                    $vehiculos_alerta->setComando(str_replace('!', '', $comando));
                                    $vehiculos_alerta->setSim($sms['SenderNumber']);
                                    $vehiculos_alerta->setGpsVehiculoId($vehiculo->getVehiculoId());
                                    $vehiculos_alerta->setLatitud(str_replace('lat:', '', $latitud));
                                    $vehiculos_alerta->setLongitud(str_replace('long:', '', $longitud));
                                    $vehiculos_alerta->setVelocidad(str_replace('speed:', '', $speed));
                                    $vehiculos_alerta->setEnlace(str_replace('enlace:', '', $enlace));
                                    $vehiculos_alerta->setFechaGps(date('Y-m-d H:i:s', strtotime($new_time)));
                                    $vehiculos_alerta->setFechaGammu(date('Y-m-d H:i:s', strtotime($sms['UpdatedInDB'])));
                                    $vehiculos_alerta->setIdUpdate(0);
                                    $vehiculos_alerta->setIdCreate(0);
                                    $vehiculos_alerta->setIpUpdate('127.0.0.1');
                                    $vehiculos_alerta->setIpCreate('127.0.0.1');

                                    $vehiculos_alerta->save();

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
                    }
                }
                ////////////////
                //FIN DE PROCESO DE RECUPERACION
                ////////////////
            }
        }
    }else {
        echo 'EL ARCHIVO DE CONFIGURACION DE GPS TRACKER NO EXISTE. CREELO Y REINTENTE';
    }
  }
}
