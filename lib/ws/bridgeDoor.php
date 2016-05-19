<?php
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('acceso', '', true);
sfContext::createInstance($configuration);

$format = $_REQUEST['format'];
if($format == "json") {
    if(isset($_REQUEST['callback'])) {
        $callback = $_REQUEST['callback'];
        
        
        
        // ########### CAPTURAR IP, PUERTA Y PC ##############
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
            $puerta=$_SERVER["REMOTE_ADDR"];
            $pc = gethostbyaddr($ip);
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
            $pc = gethostbyaddr($ip);
            $puerta='NINGUNA';
        }
        
        $data = $_REQUEST['data'];
        
        // BUSCAR EL SERVIDOR DE CONFIANZA SOLICITADO
        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['dominio']);

        $ip_server_good = "127.3.0.1";
        // ########### VERIFICAR IP VALIDA DE ACCESO ##############
        $rangos_ip = explode(';',$ip_server_good);
        $rangos_ip[] = '127.0.0.1';

        $ip_i = 'i'.$ip;
        $ip_valida = FALSE;
        foreach ($rangos_ip as $rango_ip) {
            $rango_ip_i = 'i'.$rango_ip;
            if(preg_match('/'.$rango_ip_i.'/', $ip_i)){
               $ip_valida = TRUE; 
            }
        }

        if($servidor_confianza){
            //BUSCAR EL WS DISPONIBLE EN EL DOMINIO SOLICITADO
            $servicio_disponible = Doctrine::getTable('Siglas_ServiciosDisponibles')->findOneByServidorConfianzaIdAndFuncionAndStatus($servidor_confianza->getId(),$data['content']['function'],'A');
            
            if($servicio_disponible){
                // BUSCAR SI LA IP QUE SOLICITA TIENE ACCESO A LA FUNCION SOLICITADA
                $servicios_disponibles_confianza = Doctrine::getTable('Siglas_ServiciosDisponiblesConfianza')->findOneByServiciosDisponiblesIdAndIpPermitidaAndStatus($servicio_disponible->getId(),$ip,'A');
                
                if($servicios_disponibles_confianza){

                    $param['class'] = 'puente';
                    $param['function'] = 'frontera';

                    $ws_array['param'] = $param; 
                    $ws_array['content'] = $data['content'];

                    $PK_public_client = trustedServer::openPublicKey($servidor_confianza->getDominio());

                    if(!isset($PK_public_client['error'])){
                        $data_sing_and_crypt = trustedServer::encryptAndSing($servidor_confianza->getDominio(),$ws_array);

                        $tipo['class']=$param['class'];
                        $tipo['function']=$param['function'];

                        $parametros = $data['content'];

                        $interoperabilidad_enviada = new Siglas_InteroperabilidadEnviada();
                        $interoperabilidad_enviada->setServidorConfianzaId($servidor_confianza->getId());
                        $interoperabilidad_enviada->setServidorCertificadoId($PK_public_client['crt_id']);
                        $interoperabilidad_enviada->setTipo(sfYAML::dump($tipo));
                        $interoperabilidad_enviada->setFirma($data_sing_and_crypt['sing']);
                        $interoperabilidad_enviada->setCadena(sfYAML::dump($data_sing_and_crypt['data']));
                        $interoperabilidad_enviada->setPaquete(strtotime(date('Y-m-d H:i:s')));
                        $interoperabilidad_enviada->setPartes(1);
                        $interoperabilidad_enviada->setParte(1);
                        $interoperabilidad_enviada->setStatus('E');
                        $interoperabilidad_enviada->setParametros(sfYAML::dump($parametros));
                        $interoperabilidad_enviada->save();
                        // SETEAR COMO PARAMETRO EL ID DE LA CORRESPONDENCIA QUE ENVIA

                        $interoperabilidad_enviada->setPaquete($interoperabilidad_enviada->getId());
                        $interoperabilidad_enviada->save();

                        $traza = '';
                        $traza['parametros'] = $parametros;
                        $traza['parametros']['interoperabilidad_envio_solicitud_id'] = $interoperabilidad_enviada->getId();
                        $traza['paquete'] = $interoperabilidad_enviada->getId();
                        $traza['partes'] = 1;
                        $traza['parte'] = 1;

                        // ENCRIPTAMOS TRAZA
                        $traza_crypt = trustedServer::encrypt($servidor_confianza->getDominio(),$traza);

                        // INCORPORAMOS INFORMACION DE LA TRAZA AL ENVIO
                        $data_sing_and_crypt['traza'] = $traza_crypt;

                        require_once(sfConfig::get("sf_root_dir").'/lib/ws/nusoap/nusoap.php');

                        // RUTA DEL SERVIDOR Y SERVICIO
                        $wsdl = $servidor_confianza->getDominio()."/ws.php?wsdl";

                        // INSTANCIAMOS EL WS
                        $client = new nusoap_client($wsdl,'wsdl');

                        $param = array('data'=>$data_sing_and_crypt);

                        // LLAMADO DEl SERVICIO PARA QUE LLENE LA VARIABLE $response
                        $response = $client->call('recibir', $param);            

                        $tipo['class']=$param['class'];
                        $tipo['function']='respuesta_recibida';

                        $parametros = '';
                        $traza = trustedServer::decrypt($response['traza']);
                        $parametros = $traza['parametros'];

                        // REGISTRAMOS TRAZA DE RECEPCION DE DATOS DE INTEROPERABILIDAD
                        $interoperabilidad_recibida = new Siglas_InteroperabilidadRecibida();
                        $interoperabilidad_recibida->setServidorConfianzaId($servidor_confianza->getId());
                        $interoperabilidad_recibida->setServidorCertificadoId($PK_public_client['crt_id']);
                        $interoperabilidad_recibida->setInteroperabilidadEnviadaId($interoperabilidad_enviada->getId());
                        $interoperabilidad_recibida->setTipo(sfYAML::dump($tipo));
                        $interoperabilidad_recibida->setFirma($response['sing']);
                        $interoperabilidad_recibida->setCadena(sfYAML::dump($response['data']));
                        $interoperabilidad_recibida->setPaquete($traza['paquete']);
                        $interoperabilidad_recibida->setPartes($traza['partes']);
                        $interoperabilidad_recibida->setParte($traza['parte']);
                        $interoperabilidad_recibida->setParametros(sfYAML::dump($parametros));
                        $interoperabilidad_recibida->save();

                        $data_responce = trustedServer::verifyAndDecrypt($response);

                        if($data_responce['notify']['status']=='ok'){
                            $interoperabilidad_enviada->setStatus('R');
                            $interoperabilidad_enviada->save();
                        } else {
                            // EL SERVIDOR DEL WS RETORNO UN ERROR
                            // SE DEBE ENVIAR CORREO ELECTRONICO AL ADMINISTRADOR DEL SERVIDOR REMOTO
                        }

                        unset($data_responce['param']);
                        echo "$callback(" . json_encode($data_responce) . ")";
                    } else {
                        $response['notify']['status']='error';
                        $response['notify']['message']='No se encontro la llave publica del servidor del WS';
                
                        echo "$callback(" . json_encode($response) . ")";
                    }
                } else {
                    $response['notify']['status']='error';
                    $response['notify']['message']='IP '.$ip.' sin acceso al SIGLAS para el consumo del Web Service externo '.$data['content']['function'].' del dominio '.$data['dominio'].'.';

                    echo "$callback(" . json_encode($response) . ")";
                }
            } else {
                $response['notify']['status']='error';
                $response['notify']['message']='El servidor SIGLAS que solicito no posee registrada la funcion '.$data['content']['function'].'.';

                echo "$callback(" . json_encode($response) . ")";
            }
        } else {
            $response['notify']['status']='error';
            $response['notify']['message']='No se encuentra registrado el dominio '.$data['dominio'].' como SIGLAS de confianza.';

            echo "$callback(" . json_encode($response) . ")";
        }
    }
}