<?php

class Sms {
    static function notificacion_personal($aplicacion, $numero, $mensaje, $modem_masivos, $id=NULL) {
        //el parametro $modem_masivos indica dispositivo a utilizar para el envio
        //si este es 'auto' se seleccionara el que tenga menos carga.
        if($modem_masivos== 'auto') {
            $modem_masivos= self::available_modem();
        }
        
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        //AGREGA 0 A NUMEROS EN CASO DE EXCEL
        if ((!substr($numero, 0, 1 )=='0')) {
            $numero = '0'.$numero;
        }

        if($sf_sms['activo']==true && $sf_sms['aplicaciones'][$aplicacion]['activo']==true){

            if(($numero!=null) && (strlen($numero)==11) &&
              (substr($numero, 0, 4 )=='0414' || substr($numero, 0, 4 )=='0424') ||
              (substr($numero, 0, 4 )=='0412' || substr($numero, 0, 4 )=='0422') ||
              (substr($numero, 0, 4 )=='0416' || substr($numero, 0, 4 )=='0426'))
            {
                //$texto="SIGLAS-".sfConfig::get('sf_siglas').": ".$mensaje['emisor'].'; '.trim($mensaje['mensaje']);
                $texto=sfConfig::get('sf_siglas').": ".trim($mensaje['mensaje']);

                $texto = str_replace('á', 'a', $texto);
                $texto = str_replace('Á', 'A', $texto);
                $texto = str_replace('é', 'e', $texto);
                $texto = str_replace('É', 'E', $texto);
                $texto = str_replace('í', 'i', $texto);
                $texto = str_replace('Í', 'I', $texto);
                $texto = str_replace('ó', 'o', $texto);
                $texto = str_replace('Ó', 'O', $texto);
                $texto = str_replace('ú', 'u', $texto);
                $texto = str_replace('Ú', 'U', $texto);
                $texto = str_replace('Ñ', 'n', $texto);
                $texto = str_replace("'", " ", $texto);

                $texto = str_replace('  ', ' ', $texto);

                $texto_puro = new herramientas();
                $texto = $texto_puro->limpiar_metas($texto);

                $ban=0;
                if(strlen($texto)>160) {
                    $texto = explode(' ', $texto); $ii=0; $jj=0; $sms[$ii]='';
                    while($ban==0) {
                        $sms_temp=$sms[$ii];
                        $sms_temp.=$texto[$jj];

                        if(count($texto)>$jj && strlen($sms_temp)!=160) $sms_temp.=' ';

                        if(strlen($sms_temp)>160) { $ii++; $sms[$ii]=''; }
                        else { $sms[$ii]=$sms_temp; $jj++; }

                        if(count($texto)<=$jj)$ban=1;
                    }
                    
                    sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_160',count($sms));
                } else { 
                    $sms[0] = $texto; 
                    sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_160',1);
                }

                $aplicacionId= '';
                if($id != NULL)
                    $aplicacionId= $aplicacion.'-'.$id;
                else
                    $aplicacionId= $aplicacion;
                $dias = array(1=>'lunes',2=>'martes',3=>'miercoles',4=>'jueves',5=>'viernes',6=>'sabado',7=>'domingo');

                $fecha_envio = date('Y-m-d');
                $actual = date('N', strtotime($fecha_envio));

                $listo=0; $count=0;
                while($listo==0)
                {
                    if($sf_sms['aplicaciones'][$aplicacion]['frecuencia'][$dias[$actual]]==true){
                        $listo=1;
                    } else {
                        $fecha_envio = date('Y-m-d',strtotime('+1 day ' . $fecha_envio));

                        $actual++;
                        if($actual==8)
                            $actual=1;
                    }

                    $count++;
                    if($count>6)
                        $listo=1;
                }

                $desde = $sf_sms['aplicaciones'][$aplicacion]['horario']['desde'];
                $hasta = $sf_sms['aplicaciones'][$aplicacion]['horario']['hasta'];

                if($count<8)
                {
                    if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query') &&
                       sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query')!=' '){
                        $query = '';
                    } else {
                        if($sf_sms['conexion_gammu']['version']=='1.28')
                            $query = "INSERT INTO outbox(destinationnumber,textdecoded,senderid, creatorid,sendingdatetime) VALUES ";
                        elseif($sf_sms['conexion_gammu']['version']=='1.31')
                            $query = "INSERT INTO outbox(\"DestinationNumber\",\"TextDecoded\",\"SenderID\",\"CreatorID\",\"SendAfter\",\"SendBefore\",\"SendingDateTime\") VALUES ";
                    }

                    for($ii=0;$ii<count($sms);$ii++)
                    {
                        if($sf_sms['conexion_gammu']['version']=='1.28'){
                            $query .= "('".$numero."', '".$sms[$ii]."', '".$modem_masivos."','".$aplicacionId."', '".$fecha_envio."'), ";
                        } elseif($sf_sms['conexion_gammu']['version']=='1.31') {
                            $query .= "('".$numero."', '".$sms[$ii]."', '".$modem_masivos."','".$aplicacionId."', '".$desde."', '".$hasta."', '".$fecha_envio."'), ";
                        }
                    }

                    $query_count = 0;
                    if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query')){
                        $query = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query').$query;





                            $query_count_progreso = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count_progreso');
                            $query_count_progreso++;
                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_progreso',$query_count_progreso);






                        if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count')>0){
                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_query',$query);

                            $query_count = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count');
                            $query_count--;
                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count',$query_count);
                        }
                    }

                    if($query_count%100==0){
                        // ##########################
                        // ##########################
                        // ##########################

                        $query .= '$%&';
                        $query = str_replace(', $%&', ';', $query);

                        $manager = Doctrine_Manager::getInstance()
                                            ->openConnection(
                                            'pgsql' . '://' .
                                            $sf_sms['conexion_gammu']['username'] . ':' .
                                            $sf_sms['conexion_gammu']['password'] . '@' .
                                            $sf_sms['conexion_gammu']['host'] . '/' .
                                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

                        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                        Doctrine_Manager::getInstance()->closeConnection($manager);

                        // ##########################
                        // ##########################
                        // ##########################

                        sfContext::getInstance()->getUser()->setAttribute('sms_masivo_query',' ');
//                        sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_progreso',0);
                    }

                    unset($enviado); unset($sf_sms); unset($texto); unset($desde); unset($hasta); unset($sms); unset($conexion);
                }
            }
        }

    }

    static function cancelar($aplicacion, $id=NULL) {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        $manager = Doctrine_Manager::getInstance()
                            ->openConnection(
                            'pgsql' . '://' .
                            $sf_sms['conexion_gammu']['username'] . ':' .
                            $sf_sms['conexion_gammu']['password'] . '@' .
                            $sf_sms['conexion_gammu']['host'] . '/' .
                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

        $query = "DELETE FROM outbox WHERE \"CreatorID\" = '".$aplicacion.'-'.$id."';";
        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

        $query = "DELETE FROM outbox WHERE \"CreatorID\" ILIKE '".$aplicacion.'-'.$id."-%';";
        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

        Doctrine_Manager::getInstance()->closeConnection($manager);
    }

    static function pausar($aplicacion, $id=NULL) {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        $manager = Doctrine_Manager::getInstance()
                            ->openConnection(
                            'pgsql' . '://' .
                            $sf_sms['conexion_gammu']['username'] . ':' .
                            $sf_sms['conexion_gammu']['password'] . '@' .
                            $sf_sms['conexion_gammu']['host'] . '/' .
                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

        $anio = date('Y')+100;
        $date = $anio.'-01-01';

        $query = "UPDATE outbox SET \"SendingDateTime\" = '".$date."' WHERE \"CreatorID\" = '".$aplicacion."-".$id."';";
        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

        $query = "UPDATE outbox SET \"SendingDateTime\" = '".$date."' WHERE \"CreatorID\" ILIKE '".$aplicacion."-".$id."-%';";
        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

        Doctrine_Manager::getInstance()->closeConnection($manager);
    }

    static function continuar($aplicacion, $id=NULL) {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        $manager = Doctrine_Manager::getInstance()
                            ->openConnection(
                            'pgsql' . '://' .
                            $sf_sms['conexion_gammu']['username'] . ':' .
                            $sf_sms['conexion_gammu']['password'] . '@' .
                            $sf_sms['conexion_gammu']['host'] . '/' .
                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

        $date = date('Y-m-d');
        $query = "UPDATE outbox SET \"SendingDateTime\" = '".$date."' WHERE \"CreatorID\" = '".$aplicacion."-".$id."';";

        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

        Doctrine_Manager::getInstance()->closeConnection($manager);
    }

    static function notificacion_sistema($aplicacion, $numero, $mensaje) {
        //no se utiliza modem masivo pre seleccionado puesto que es notificacion de siglas
        //descripcion de seleccion de modem en funcion available_modem_free
        
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        //solo notica si los modulos estan activos
        if($sf_sms['activo']==true && $sf_sms['aplicaciones'][$aplicacion]['activo']==true){
            
            $modem_masivos= self::available_modem_free();

            $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");
            $conexion = 'dbname='.$sf_sms['conexion_gammu']['dbname'].
                   ' port='.$sf_sms['conexion_gammu']['port'].
                   ' host='.$sf_sms['conexion_gammu']['host'].
                   ' user='.$sf_sms['conexion_gammu']['username'].
                   ' password='.$sf_sms['conexion_gammu']['password'];

            if(($numero!=null) && (strlen($numero)==11) &&
              (substr($numero, 0, 4 )=='0414' || substr($numero, 0, 4 )=='0424') ||
              (substr($numero, 0, 4 )=='0412' || substr($numero, 0, 4 )=='0422') ||
              (substr($numero, 0, 4 )=='0416' || substr($numero, 0, 4 )=='0426'))
            {
                $texto="SIGLAS-".sfConfig::get('sf_siglas')." : ".$mensaje['emisor'].'; '.trim($mensaje['mensaje']);

                $texto = str_replace('á', 'a', $texto);
                $texto = str_replace('Á', 'A', $texto);
                $texto = str_replace('é', 'e', $texto);
                $texto = str_replace('É', 'E', $texto);
                $texto = str_replace('í', 'i', $texto);
                $texto = str_replace('Í', 'I', $texto);
                $texto = str_replace('ó', 'o', $texto);
                $texto = str_replace('Ó', 'O', $texto);
                $texto = str_replace('ú', 'u', $texto);
                $texto = str_replace('Ú', 'U', $texto);
                $texto = str_replace('Ñ', 'n', $texto);

                $texto = str_replace('  ', ' ', $texto);

                $texto_puro = new herramientas();
                $texto = $texto_puro->limpiar_metas($texto);

                $ban=0;
                if(strlen($texto)>160) {
                    $texto = explode(' ', $texto); $ii=0; $jj=0; $sms[$ii]='';
                    while($ban==0) {
                        $sms_temp=$sms[$ii];
                        $sms_temp.=$texto[$jj];

                        if(count($texto)>$jj && strlen($sms_temp)!=160) $sms_temp.=' ';

                        if(strlen($sms_temp)>160) { $ii++; $sms[$ii]=''; }
                        else { $sms[$ii]=$sms_temp; $jj++; }

                        if(count($texto)<=$jj)$ban=1;
                    }
                }
                else
                { $sms[0] = $texto; }

                $fecha_envio = date('Y-m-d');
                $desde = '00:00:00';
                $hasta = '23:59:59';

//                if($count<8)
//                {
                    $conn= self::count_device();
                    if($conn!= 'no_conn') {
                        for($ii=0;$ii<count($sms);$ii++)
                        {
                            if($sf_sms['conexion_gammu']['version']=='1.28'){
                                $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                                select dblink_exec('".$conexion."',
                                'INSERT INTO outbox(destinationnumber,textdecoded,senderid,creatorid,sendingdatetime)
                                VALUES (''".$numero."'', ''".$sms[$ii]."'', ''".$aplicacion."'', ''".$fecha_envio."'')')");
                            } elseif($sf_sms['conexion_gammu']['version']=='1.31') {
                                $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                                select dblink_exec('".$conexion."',
                                'INSERT INTO outbox(\"DestinationNumber\",\"TextDecoded\",\"SenderID\",\"CreatorID\",\"SendAfter\",\"SendBefore\",\"SendingDateTime\")
                                VALUES (''".$numero."'', ''".$sms[$ii]."'', ''".$modem_masivos."'', ''".$aplicacion."'', ''".$desde."'', ''".$hasta."'', ''".$fecha_envio."'')')");
                            }
                        }
                    }
//                }
            }
        }
    }

    static function count_device() {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");
        $conexion = 'host='.$sf_sms['conexion_gammu']['host'].
               ' port='.$sf_sms['conexion_gammu']['port'].
               ' dbname='.$sf_sms['conexion_gammu']['dbname'].
               ' user='.$sf_sms['conexion_gammu']['username'].
               ' password='.$sf_sms['conexion_gammu']['password'];

        $conn = @pg_connect($conexion);
        if($conn){
            if($sf_sms['conexion_gammu']['version']=='1.31')
                $result=pg_query($conn, 'SELECT "ID" as id, "Battery" as battery, "Signal" as signal, "Sent" as sent FROM public.phones WHERE "Send"= TRUE AND "TimeOut" > current_timestamp - interval \'1 minute\' ORDER BY "InsertIntoDB" ASC');
            elseif($sf_sms['conexion_gammu']['version']=='1.28')//OJO CON LA VERSION 1.28 GAMMU REVISAR ESTOS QUERIES
                $result=pg_query($conn, 'SELECT count(*), battery, signal, sent FROM public.phones WHERE send= TRUE AND "tiimeout" > current_timestamp - interval \'1 minute\' ORDER BY "InsertIntoDB" DESC');

            if(!$result)
                return false;
            else{
                $ar= pg_fetch_all($result);
                return $ar;
                pg_close($conn);
            }
        }else{
            return 'no_conn';
        }

    }

    static function process_sms($table, $id=NULL, $id_usr=NULL) {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");
        $conexion = 'host='.$sf_sms['conexion_gammu']['host'].
               ' port='.$sf_sms['conexion_gammu']['port'].
               ' dbname='.$sf_sms['conexion_gammu']['dbname'].
               ' user='.$sf_sms['conexion_gammu']['username'].
               ' password='.$sf_sms['conexion_gammu']['password'];

        $conn = @pg_connect($conexion);
        if($conn){
            if($id != NULL) {
                //BUSCARA SOLO PROCESADOS DE UN ID (UN ENVIO PARTICULAR)
                if($sf_sms['conexion_gammu']['version']=='1.31')
                    $result=pg_query($conn, 'SELECT COUNT("ID") as cant FROM '.$table.' WHERE "CreatorID" = \'mensajes-'.$id.'\'');
                elseif($sf_sms['conexion_gammu']['version']=='1.28')
                    $result=pg_query($conn, 'SELECT COUNT(id) as cant FROM '.$table.' WHERE "creatorId" = \'mensajes-'.$id.'\'');

                if(!$result)
                    return false;
                else{
                    $ar= pg_fetch_all($result);
                    return $ar;
                    pg_close($conn);
                }
            }elseif($id_usr != NULL) {
                //BUSCARA TODOS LOS PROCESADOS SEGUN
                $mensajes_usuario = Doctrine::getTable('Public_Mensajes')->findByFuncionarioEnviaIdAndStatus($id_usr, 'A');

                $pre_query = 'SELECT COUNT("ID") as cant FROM '.$table.' WHERE "CreatorID" = \'mensajes-\'';

                if($sf_sms['conexion_gammu']['version']=='1.31') {
                    for($i=0; $i < count($mensajes_usuario); $i++) {
                        if($i== 0)
                            $pre_query = 'SELECT COUNT("ID") as cant FROM '.$table.' WHERE "CreatorID" = \'mensajes-'.$mensajes_usuario[$i]['id'].'\'';
                        else
                            $pre_query .= ' OR "CreatorID" = \'mensajes-'.$mensajes_usuario[$i]['id'].'\'';
                    }
                    $result=pg_query($conn, $pre_query);
                }elseif($sf_sms['conexion_gammu']['version']=='1.28') {
                    for($i=0; $i < count($mensajes_usuario); $i++) {
                        if($i== 0)
                            $pre_query .= 'SELECT COUNT("ID") as cant FROM '.$table.' WHERE "creatorId" = \'mensajes-'.$mensajes_usuario[$i]['id'].'\'';
                        else
                            $pre_query .= ' OR "CreatorID" = \'mensajes-'.$mensajes_usuario[$i]['id'].'\'';
                    }
                    $result=pg_query($conn, $pre_query);
                }

                if(!$result)
                    return false;
                else{
                    $ar= pg_fetch_all($result);
                    return $ar;
                    pg_close($conn);
                }
            }
        }else{
            return 'no_conn';
        }

    }

    static function clean_outbox($id_usr) {
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");
        $conexion = 'host='.$sf_sms['conexion_gammu']['host'].
               ' port='.$sf_sms['conexion_gammu']['port'].
               ' dbname='.$sf_sms['conexion_gammu']['dbname'].
               ' user='.$sf_sms['conexion_gammu']['username'].
               ' password='.$sf_sms['conexion_gammu']['password'];

        $conn = @pg_connect($conexion);
        if($conn){

            $mensajes_usuario = Doctrine::getTable('Public_Mensajes')->findByFuncionarioEnviaId($id_usr);

            $pre_query= '';

            if($sf_sms['conexion_gammu']['version']=='1.31') {
                foreach($mensajes_usuario as $values) {
                    $pre_query.= 'DELETE FROM outbox WHERE "CreatorID" = \'mensajes-'. $values->getId() .'\';';
                }
            }elseif($sf_sms['conexion_gammu']['version']=='1.28') {
                foreach($mensajes_usuario as $values) {
                    $pre_query.= 'DELETE FROM outbox WHERE "creatorId" = \'mensajes-'. $values->getId() .'\';';
                }
            }

            //SOLO COMO EXCEPCIÓN SE PASA ESTE QUERY FALSO EN CASO DE.
            if($pre_query == '')
                $pre_query= 'DELETE FROM outbox WHERE "CreatorID" = \'mensajes-\';';

            $result=pg_query($conn, $pre_query);

            if(!$result)
                return false;
            else {
                $ar = pg_fetch_all($result);
                return $ar;
                pg_close($conn);
            }
        }else{
            return 'no_conn';
        }
    }
    
    static function modems_per_user() {
        $sf_sms = sfYaml::load(sfConfig::get("sf_root_dir") . "/config/siglas/sms.yml");
        $actual = Doctrine::getTable('Funcionarios_FuncionarioCargo')->unidadCargoActual(sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));

        $cargo_id = $actual[0]['id_cargo'];
        $funcionario_id = sfContext::getInstance()->getUser()->getAttribute('funcionario_id');
//        $funcio_modems_cargo = Array();
//        $funcio_modems_particular = Array();
        $mis_modems = Array();
        $arreglo1 = Array();
        $arreglo2 = Array();
        $arreglo3 = Array();
        $arreglo4 = Array();
        $main_count= 0;
        $activo_particular= false;
        //Si el usuario esta asignado para usar sms masivo pero sin modems, se adjudican todos.
        $empty_is_all= false;

        if ($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['activo'] == true)
            $activo_particular = true;
        
        if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados']['unico'])) {
//                $funcio_modems_cargo[$main_count]['dato'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['unico']['dato'];
//                $funcio_modems_cargo[$main_count]['modems'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['unico']['modems'];
//                $funcio_modems_cargo++;

                //FUNCIONAL
                if ($sf_sms['aplicaciones']['mensajes_externos']['autorizados']['unico']['dato'] == $cargo_id) {
                    $arreglo1 = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['unico']['modems'];
                    if($arreglo1[0] == ''){
                        $empty_is_all= true;
                    }
                }
            }
            if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros'])) {
                for ($i = 0; $i < count($sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros']); $i++) {
//                    $funcio_modems_cargo[$main_count]['dato'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros'][$i]['dato'];
//                    $funcio_modems_cargo[$main_count]['modems'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros'][$i]['modems'];
//                    $main_count++;

                    //FUNCIONAL
                    if ($sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros'][$i]['dato'] == $cargo_id) {
                        $arreglo2 = $sf_sms['aplicaciones']['mensajes_externos']['autorizados']['otros'][$i]['modems'];
                        if($arreglo2[0] == ''){
                            $empty_is_all= true;
                    }   
                    }
                }
            }

            $main_count = 0;
            if ($activo_particular) {
                if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico'])) {
                    $part = explode('#', $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['dato']);
//                    $funcio_modems_particular[$main_count]['dato'] = $part[1];
//                    $funcio_modems_particular[$main_count]['modems'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['modems'];
//                    $main_count++;

                    //FUNCIONAL
                    if ($part[1] == $funcionario_id) {
                        $arreglo3 = $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['unico']['modems'];
                        if($arreglo3[0]== ''){
                            $empty_is_all= true;
                        }
                    }
                }
                if (isset($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'])) {
                    for ($i = 0; $i < count($sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros']); $i++) {
                        $part = explode('#', $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['dato']);
//                        $funcio_modems_particular[$main_count]['dato'] = $part[1];
//                        $funcio_modems_particular[$main_count]['modems'] = $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['modems'];
//                        $main_count++;

                        //FUNCIONAL
                        if ($part[1] == $funcionario_id) {
                            $arreglo4 = $sf_sms['aplicaciones']['mensajes_externos']['autorizados_particulares']['otros'][$i]['modems'];
                            if($arreglo4[0] == ''){
                                $empty_is_all= true;
                            }
                        }
                    }
                }
            }

            if($empty_is_all){
                $mis_modems= array(0=> 'all');
            }else {
                $mis_modems = array_merge((array) $arreglo1, (array) $arreglo2, (array) $arreglo3, (array) $arreglo4);
            }
            if(empty($mis_modems))
                $mis_modems= array(0=> 'all');
            return $mis_modems;
    }
    
    static function available_modem() {
        //Esta rutina toma en cuenta los dispositivos activos, dispositivos en uso, y si no hay dispositivos en uso
        
        //Modems actualmente activos en gammu, TODOS
        $device= self::count_device();
        
        //Modems asignados por yml a este usuario, POR CARGO Y ID FUNCIONARIO
        $assigned_modems= self::modems_per_user();

        //Array para modems asignados y existentes (para eso se compara con $device)
        $modems_assigned_exists= Array();
        if(is_array($device)) {
            for ($j= 0; $j < count($device); $j++) {
                if(in_array($device[$j]['id'], $assigned_modems) || $assigned_modems[0] == 'all') {
                    $modems_assigned_exists[]= $device[$j]['id'];
                }
            }
        }
        
        //crea un array con dispositivos activos
        $devices= array();
        if(count($modems_assigned_exists) > 0) {
            //Este array maneja la cantidad de sms activos para cada modem
            $modem_disponible = Doctrine::getTable('Public_MensajesMasivos')->modemDisponible();

            $value= 0;
            for ($i=0; $i < count($modems_assigned_exists); $i++) {
                foreach($modem_disponible as $val){
                    $value= 0;
                    if($val->getModem() == $modems_assigned_exists[$i]) {
                        $value= $val->getSumt();
                        break;
                    }
                }
                $devices[$modems_assigned_exists[$i]]= $value;
            }
        }

        //captura el dispositivo con menos mensajes activos
        $availabe_device= 'modem1';
        $position= 1;
        foreach($devices as $key=> $values) {
            if($position== 1){
                $less= $values;
                $availabe_device= $key;
            }
            if($values < $less) {
                $less= $values;
                $availabe_device= $key;
            }
            $position++;
        }
        return $availabe_device;
    }
    
    static function available_modem_free() {
        //Esa rutina es utilizada por el siglas solo para notificaciones sms
        //toma en cuenta solo modems disponibles de gammu sin importar asignados
        
        //Modems actualmente activos en gammu, TODOS
        $device= self::count_device();
        
        //crea un array con dispositivos activos
        $devices= array();
        if(is_array($device)) {
            if(count($device) > 0) {
                $modem_disponible = Doctrine::getTable('Public_MensajesMasivos')->modemDisponible();

                $value= 0;
                for ($i=0; $i < count($device); $i++) {
                    foreach($modem_disponible as $val){
                        $value= 0;
                        if($val->getModem() == $device[$i]['id']) {
                            $value= $val->getSumt();
                            break;
                        }
                    }
                    $devices[$device[$i]['id']]= $value;
                }
            }    
        }
        
        //captura el dispositivo con menos mensajes activos
        $availabe_device= 'modem1';
        $position= 1;
        foreach($devices as $key=> $values) {
            if($position== 1){
                $less= $values;
                $availabe_device= $key;
            }
            if($values < $less) {
                $less= $values;
                $availabe_device= $key;
            }
            $position++;
        }

        return $availabe_device;
    }
    
    //FUNCION PARA EL ENVIO DE COMANDOS AT A LOS DISPOSITOS GPS
    static function sms_at($aplicacion, $numero, $mensaje, $modem_masivos) {
        //el parametro $modem_masivos indica dispositivo a utilizar para el envio
        //si este es 'auto' se seleccionara el que tenga menos carga.
        if($modem_masivos== 'auto') {
            $modem_masivos= self::available_modem();
        }
        
        $sf_sms = sfYaml::load(sfConfig::get('sf_root_dir')."/config/siglas/sms.yml");

        //AGREGA 0 A NUMEROS EN CASO DE EXCEL
        if ((!substr($numero, 0, 1 )=='0')) {
            $numero = '0'.$numero;
        }

        if($sf_sms['activo']==true && $sf_sms['aplicaciones'][$aplicacion]['activo']==true){

            if(($numero!=null) && (strlen($numero)==11) &&
              (substr($numero, 0, 4 )=='0414' || substr($numero, 0, 4 )=='0424') ||
              (substr($numero, 0, 4 )=='0412' || substr($numero, 0, 4 )=='0422') ||
              (substr($numero, 0, 4 )=='0416' || substr($numero, 0, 4 )=='0426'))
            {
                //$texto="SIGLAS-".sfConfig::get('sf_siglas').": ".$mensaje['emisor'].'; '.trim($mensaje['mensaje']);
//                $texto=sfConfig::get('sf_siglas').": ".trim($mensaje['mensaje']);
//
//                $texto = str_replace('á', 'a', $texto);
//                $texto = str_replace('Á', 'A', $texto);
//                $texto = str_replace('é', 'e', $texto);
//                $texto = str_replace('É', 'E', $texto);
//                $texto = str_replace('í', 'i', $texto);
//                $texto = str_replace('Í', 'I', $texto);
//                $texto = str_replace('ó', 'o', $texto);
//                $texto = str_replace('Ó', 'O', $texto);
//                $texto = str_replace('ú', 'u', $texto);
//                $texto = str_replace('Ú', 'U', $texto);
//                $texto = str_replace('Ñ', 'n', $texto);
//                $texto = str_replace("'", " ", $texto);
//
//                $texto = str_replace('  ', ' ', $texto);
//
//                $texto_puro = new herramientas();
//                $texto = $texto_puro->limpiar_metas($texto);

//                $ban=0;
//                if(strlen($texto)>160) {
//                    $texto = explode(' ', $texto); $ii=0; $jj=0; $sms[$ii]='';
//                    while($ban==0) {
//                        $sms_temp=$sms[$ii];
//                        $sms_temp.=$texto[$jj];
//
//                        if(count($texto)>$jj && strlen($sms_temp)!=160) $sms_temp.=' ';
//
//                        if(strlen($sms_temp)>160) { $ii++; $sms[$ii]=''; }
//                        else { $sms[$ii]=$sms_temp; $jj++; }
//
//                        if(count($texto)<=$jj)$ban=1;
//                    }
//                    
//                    sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_160',count($sms));
//                } else { 
//                    $sms[0] = $texto; 
//                    sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_160',1);
//                }

//                $aplicacionId= '';
//                if($id != NULL)
//                    $aplicacionId= $aplicacion.'-'.$id;
//                else
                    $aplicacionId= $aplicacion;
//                $dias = array(1=>'lunes',2=>'martes',3=>'miercoles',4=>'jueves',5=>'viernes',6=>'sabado',7=>'domingo');
//
                $fecha_envio = date('Y-m-d');
//                $actual = date('N', strtotime($fecha_envio));
//
//                $listo=0; $count=0;
//                while($listo==0)
//                {
//                    if($sf_sms['aplicaciones'][$aplicacion]['frecuencia'][$dias[$actual]]==true){
//                        $listo=1;
//                    } else {
//                        $fecha_envio = date('Y-m-d',strtotime('+1 day ' . $fecha_envio));
//
//                        $actual++;
//                        if($actual==8)
//                            $actual=1;
//                    }
//
//                    $count++;
//                    if($count>6)
//                        $listo=1;
//                }
//
//                $desde = $sf_sms['aplicaciones'][$aplicacion]['horario']['desde'];
//                $hasta = $sf_sms['aplicaciones'][$aplicacion]['horario']['hasta'];

//                if($count<8)
//                {
//                    if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query') &&
//                       sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query')!=' '){
//                        $query = '';
//                    } else {
                        if($sf_sms['conexion_gammu']['version']=='1.28')
                            $query = "INSERT INTO outbox(destinationnumber,textdecoded,senderid, creatorid,sendingdatetime) VALUES ";
                        elseif($sf_sms['conexion_gammu']['version']=='1.31')
//                            $query = "INSERT INTO outbox(\"DestinationNumber\",\"TextDecoded\",\"SenderID\",\"CreatorID\",\"SendAfter\",\"SendBefore\",\"SendingDateTime\") VALUES ";
                            $query = "INSERT INTO outbox(\"DestinationNumber\",\"TextDecoded\",\"SenderID\",\"CreatorID\",\"SendingDateTime\") VALUES ";
//                    }

//                    for($ii=0;$ii<count($sms);$ii++)
//                    {
                        if($sf_sms['conexion_gammu']['version']=='1.28'){
                            $query .= "('".$numero."', '".$mensaje."', '".$modem_masivos."','".$aplicacionId."', '".$fecha_envio."'), ";
                        } elseif($sf_sms['conexion_gammu']['version']=='1.31') {
                            $query .= "('".$numero."', '".$mensaje."', '".$modem_masivos."','".$aplicacionId."', '".$fecha_envio."'), ";
                        }
//                    }

//                    $query_count = 0;
//                    if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query')){
//                        $query = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_query').$query;
//
//
//
//
//
//                            $query_count_progreso = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count_progreso');
//                            $query_count_progreso++;
//                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_progreso',$query_count_progreso);
//
//
//
//
//
//
//                        if(sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count')>0){
//                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_query',$query);
//
//                            $query_count = sfContext::getInstance()->getUser()->getAttribute('sms_masivo_count');
//                            $query_count--;
//                            sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count',$query_count);
//                        }
                    }

//                    if($query_count%100==0){
                        // ##########################
                        // ##########################
                        // ##########################

                        $query .= '$%&';
                        $query = str_replace(', $%&', ';', $query);

                        $manager = Doctrine_Manager::getInstance()
                                            ->openConnection(
                                            'pgsql' . '://' .
                                            $sf_sms['conexion_gammu']['username'] . ':' .
                                            $sf_sms['conexion_gammu']['password'] . '@' .
                                            $sf_sms['conexion_gammu']['host'] . '/' .
                                            $sf_sms['conexion_gammu']['dbname'], 'dbGAMMU');

                        $enviado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                        Doctrine_Manager::getInstance()->closeConnection($manager);

                        // ##########################
                        // ##########################
                        // ##########################

//                        sfContext::getInstance()->getUser()->setAttribute('sms_masivo_query',' ');
//                        sfContext::getInstance()->getUser()->setAttribute('sms_masivo_count_progreso',0);
//                    }

//                    unset($enviado); unset($sf_sms); unset($texto); unset($desde); unset($hasta); unset($sms); unset($conexion);
//                }
//            }
        }
    }
}
?>