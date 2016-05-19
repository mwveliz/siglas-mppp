<?php

require_once dirname(__FILE__).'/../lib/ioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ioGeneratorHelper.class.php';

/**
 * io actions.
 *
 * @package    siglas
 * @subpackage io
 * @author     Livio Lopez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ioActions extends autoIoActions
{
  public function executeRegresarConfiguraciones(sfWebRequest $request)
  {
    $this->redirect('configuracion/index?opcion=interoperabilidad');
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->getUser()->getAttributeHolder()->remove('servidor_confianza_id');
    
    $io_basica=array();
    $ids_yml_cert=array();
    
    $io_basica['confianza']=array();
    $io_basica['confianza']['status_envio'] = false;
    $io_basica['confianza']['fecha_envio'] = '';
    $io_basica['confianza']['status_recepcion'] = false;
    $io_basica['confianza']['fecha_recepcion'] = '';

    $io_basica['estructura']=array();
    $io_basica['estructura']['status_envio'] = false;
    $io_basica['estructura']['fecha_envio'] = '';
    $io_basica['estructura']['status_recepcion'] = false;
    $io_basica['estructura']['fecha_recepcion'] = '';
    
    $io_basica = sfYaml::dump($io_basica);
    
    $sf_interoperabilidad = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/interoperabilidad.yml");
    foreach ($sf_interoperabilidad as $key => $servidor) {
        $ids_yml_cert[] = $key;
        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByIdYml($key);
        
        if(!$servidor_confianza){
            
            $dominio_check = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($servidor['dominio']);
            if(!$dominio_check){
                $conn = Doctrine_Manager::connection();

                try {
                    $conn->beginTransaction();
                
                    $organismo = new Organismos_Organismo();
                    $organismo->setNombre($servidor['nombre']);
                    $organismo->setSiglas($servidor['siglas']);
                    $organismo->setTelfUno($servidor['telf_uno']);
                    $organismo->setTelfDos($servidor['telf_dos']);
                    $organismo->setEmailPrincipal($servidor['email']);
                    $organismo->save();

                    $contacto = sfYaml::dump($servidor['contacto']);
                    $servidor_confianza = new Siglas_ServidorConfianza();
                    $servidor_confianza->setIdYml($key);
                    $servidor_confianza->setOrganismoId($organismo->getId());
                    $servidor_confianza->setDominio($servidor['dominio']);
                    $servidor_confianza->setContacto($contacto);
                    $servidor_confianza->setIoBasica($io_basica);
                    $servidor_confianza->save();
                
                    $conn->commit();

                } catch(Exception $e){
                    $conn->rollBack();
                }
            } else {
                $this->getUser()->setFlash('error', 'Existen dominios repetidos ('.$servidor['dominio'].') en el listado de interoperabilidad, comuniquese con ProSoft Solutions y reporte el problema.');
            }
                
        } else {
            $actualizar = true;
            $dominio_check = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($servidor['dominio']);
            if($dominio_check){
                if($dominio_check->getId() != $servidor_confianza->getId()){
                    $this->getUser()->setFlash('error', 'Existen dominios repetidos ('.$servidor['dominio'].') en el listado de interoperabilidad, comuniquese con ProSoft Solutions y reporte el problema.');
                    $actualizar = false;
                }
            }
            
            if($actualizar == true){
                $conn = Doctrine_Manager::connection();

                try {
                    $conn->beginTransaction();

                    $organismo = Doctrine::getTable('Organismos_Organismo')->find($servidor_confianza->getOrganismoId());
                    $organismo->setNombre($servidor['nombre']);
                    $organismo->setSiglas($servidor['siglas']);
                    $organismo->setTelfUno($servidor['telf_uno']);
                    $organismo->setTelfDos($servidor['telf_dos']);
                    $organismo->setEmailPrincipal($servidor['email']);
                    $organismo->save();

                    $contacto = sfYaml::dump($servidor['contacto']);
                    $servidor_confianza->setIdYml($key);
                    $servidor_confianza->setOrganismoId($organismo->getId());
                    $servidor_confianza->setDominio($servidor['dominio']);
                    $servidor_confianza->setContacto($contacto);
                    $servidor_confianza->setIoBasica($io_basica);
                    $servidor_confianza->save();
                    $conn->commit();

                } catch(Exception $e){
                    $conn->rollBack();
                }
            }
        }
    }
    
    $servidores_sin_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->organismosConfianzaNoCertificados($ids_yml_cert);
    foreach ($servidores_sin_confianza as $servidor_sin_confianza) {
        $servidor_sin_confianza->setStatus('E');
        $servidor_sin_confianza->setDominio('SIN_CONFIANZA.'.$servidor_sin_confianza->getDominio());
        $servidor_sin_confianza->setIdYml('SIN_CONFIANZA.'.$servidor_sin_confianza->getIdYml());
        $servidor_sin_confianza->save();
    }
      
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
  
  public function executeEnviarConfianza(sfWebRequest $request)
  {
      $servidor_confianza_id = $request->getParameter('servidor_confianza_id');
        
      $ws_array['dominio']=sfConfig::get('sf_dominio');
      $PK_certificate = trustedServer::extracMyCertificate();
      $ws_array['certificado'] = $PK_certificate;
      
      $ws_array_serialize = urlencode(serialize($ws_array));

      require_once(sfConfig::get("sf_root_dir").'/lib/ws/nusoap/nusoap.php');
 
      // RUTA DEL SERVIDOR Y SERVICIO
      $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->find($servidor_confianza_id);
      $wsdl = $servidor_confianza->getDominio()."/ws.php?wsdl";

      // INSTANCIAMOS EL WS
      $client = new nusoap_client($wsdl,'wsdl');
      $param = array('data'=>$ws_array_serialize);

      // LLAMADO DEl SERVICIO PARA QUE LLENE LA VARIABLE $response
      $response = $client->call('aparear', $param);
      $response = unserialize(urldecode($response));
      
      if(!$client->getError()){
        if(!isset($response['error'])){
              $conn = Doctrine_Manager::connection();
              $conn->beginTransaction();
              try {
                  $servidor_confianza->setStatus('A');
                  $servidor_confianza->save();

                  //se debe inactivar todos los certificados encontrado e insertar el nuevo
                  $inactivar_crt_anteriores = Doctrine_Query::create()
                      ->update('Siglas_ServidorCertificado')
                      ->set('status','?', 'I')
                      ->where('servidor_confianza_id = ?', $servidor_confianza_id)
                      ->execute();

                  $servidor_certificado = Doctrine::getTable('Siglas_ServidorCertificado')->findOneByServidorConfianzaIdAndCertificado($servidor_confianza_id,$response['certificado']);


                  if(!$servidor_certificado){
                      $ssl_open = openssl_x509_parse($response['certificado']);
                      $servidor_certificado = new Siglas_ServidorCertificado();
                      $servidor_certificado->setServidorConfianzaId($servidor_confianza_id);
                      $servidor_certificado->setCertificado($response['certificado']);
                      $servidor_certificado->setDetallesTecnicos(sfYAML::dump($ssl_open));
                      $servidor_certificado->setFValidoDesde(date('Y-m-d', $ssl_open['validFrom_time_t']));
                      $servidor_certificado->setFValidoHasta(date('Y-m-d', $ssl_open['validTo_time_t']));

                      echo "<img src='/images/icon/tick.png'/> Certificado guardado con exito";
                  } else {
                      $servidor_certificado->setStatus('A');
                      echo "<img src='/images/icon/tick.png'/>".utf8_decode("Conexión establecida con exito.");
                  }

                  $servidor_certificado->save();
                  $conn->commit();

              } catch (Doctrine_Validator_Exception $e) {
                  $conn->rollBack();
                  echo "<img src='/images/icon/error.png'/> ERROR, FALLO EL REGISTRO DEL CERTIFICADO RECIBIDO.";
              }
        } else {
            echo $response['error'];
        }
      } else {
          echo "<img src='/images/icon/error.png'/> Error al conectar con el servidor, posiblemente este inactivo.";
      }

      exit();
  }
  
  public function executeAccesoServicios(sfWebRequest $request)
  {
      $this->getUser()->setAttribute('servidor_confianza_id', $request->getParameter('id'));
      $servidor = Doctrine::getTable('Siglas_ServidorConfianza')->find($request->getParameter('id'));
      $this->organismo = Doctrine::getTable('Organismos_Organismo')->find($servidor->getOrganismoId());
      
      $this->servicios = Doctrine::getTable('Siglas_ServiciosPublicados')->serviciosPublicados();
      
  }
  
  public function executeActivarAccesoServicio(sfWebRequest $request)
  {
        $servicio_id = $request->getParameter('servicio_id');
        $parametros_visibles = $request->getParameter('array_parametros_salida');

        $servicio = Doctrine::getTable('Siglas_ServiciosPublicados')->find($servicio_id);
        $parametros_salida = sfYaml::load($servicio->getParametrosSalida());

//        echo "<pre>";
//        print_r($parametros_salida); 
        foreach ($parametros_visibles as $parametro_visible => $value) {
//            echo $parametro_visible.'<br>';
            $parametro_preparado = str_replace('______', '"]["', $parametro_visible);
            $parametro_preparado = str_replace('____', '"]', $parametro_preparado);
            $parametro_preparado = str_replace('___', '["', $parametro_preparado);
//            $parametro_preparado = str_replace('["0"]', '[0]', $parametro_preparado);
//            echo $parametro_preparado.'<hr>';
            
            eval('if(!is_array($parametros_salida'.$parametro_preparado.')){
                    $parametros_salida'.$parametro_preparado.' = true;
                }');
            
//            echo '$parametros_salida'.$parametro_preparado.' = true;<br/>';
//            echo $parametro_preparado.'<hr>';
        }

        $parametros_salida = sfYaml::dump($parametros_salida);
//        print_r($parametros_salida); 

        $conn = Doctrine_Manager::connection();
        try {
            $conn->beginTransaction();

            $inactivar_servicios = Doctrine_Query::create()
              ->update('Siglas_ServiciosPublicadosConfianza')
              ->set('status','?', 'I')
              ->where('servicios_publicados_id = ?', $servicio_id)
              ->andWhere('servidor_confianza_id = ?', $this->getUser()->getAttribute('servidor_confianza_id'))
              ->andWhere('status = ?', 'A')
              ->execute();

            $servicios_publicados_confianza = new Siglas_ServiciosPublicadosConfianza();
            $servicios_publicados_confianza->setServiciosPublicadosId($servicio_id);
            $servicios_publicados_confianza->setServidorConfianzaId($this->getUser()->getAttribute('servidor_confianza_id'));
            $servicios_publicados_confianza->setParametrosSalidaPermitidos($parametros_salida);
            $servicios_publicados_confianza->save();

            $conn->commit();

        } catch(Exception $e){
            $conn->rollBack();
        }
        exit();
  }
  
  public function executeDesactivarAccesoServicio(sfWebRequest $request)
  {
        $servicio_id = $request->getParameter('servicio_id');
        
        $inactivar_servicios = Doctrine_Query::create()
          ->update('Siglas_ServiciosPublicadosConfianza')
          ->set('status','?', 'I')
          ->where('servicios_publicados_id = ?', $servicio_id)
          ->andWhere('servidor_confianza_id = ?', $this->getUser()->getAttribute('servidor_confianza_id'))
          ->andWhere('status = ?', 'A')
          ->execute();
            
        exit();
  }
  
  public function executeNotificarAccesoServicio(sfWebRequest $request)
  {
        $servicio_id= $request->getParameter('servicio_id');
        $servidor_confianza_id = $this->getUser()->getAttribute('servidor_confianza_id');
        
        $param['class'] = 'notificacion';
        $param['function'] = 'recibirServicioDisponible';
        
        $servicio_publicado = Doctrine::getTable('Siglas_ServiciosPublicados')->find($servicio_id);
        $servicio_publicado_confianza = Doctrine::getTable('Siglas_ServiciosPublicadosConfianza')->findOneByServidorConfianzaIdAndServiciosPublicadosIdAndStatus($servidor_confianza_id,$servicio_id,'A');
        
        $array_servicio_disponible['funcion'] = $servicio_publicado->getFuncion();
        $array_servicio_disponible['descripcion'] = $servicio_publicado->getDescripcion();
        $array_servicio_disponible['tipo'] = $servicio_publicado->getTipo();
        $array_servicio_disponible['crontab'] = $servicio_publicado->getCrontab();
        $array_servicio_disponible['recursos'] = $servicio_publicado->getRecursos();
        $array_servicio_disponible['parametros_entrada'] = $servicio_publicado->getParametrosEntrada();
        $array_servicio_disponible['parametros_salida'] = $servicio_publicado_confianza->getParametrosSalidaPermitidos();
        
        $array_servicio_disponible['files'][0]=base64_encode(file_get_contents(sfConfig::get('sf_upload_dir').'/interoperabilidad/recursos_internos/'.$servicio_publicado->getRecursos()));
        
        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->find($servidor_confianza_id);

        if($servidor_confianza){
            $ws_array['param'] = $param; 
            $ws_array['content'] = $array_servicio_disponible;

//                echo "<pre>ARRAY COMPLETObr/>";
//                print_r($ws_array);
//                exit();
            $data_sing_and_crypt = trustedServer::encryptAndSing($servidor_confianza->getDominio(),$ws_array);

            if(!isset($PK_public_client['error'])){
                $PK_public_client = trustedServer::openPublicKey($servidor_confianza->getDominio());

                $tipo['class']=$param['class'];
                $tipo['function']=$param['function'];

                $parametros = null;

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

//                echo "<pre>ENVIO<br/>";
//                print_r($data_sing_and_crypt);
//                    exit();
                // RUTA DEL SERVIDOR Y SERVICIO
                $wsdl = $servidor_confianza->getDominio()."/ws.php?wsdl";

                // INSTANCIAMOS EL WS
                $client = new nusoap_client($wsdl,'wsdl');
                $client->response_timeout = 200;
                $param_ws = array('data'=>$data_sing_and_crypt);


                // LLAMADO DEl SERVICIO PARA QUE LLENE LA VARIABLE $response
                $response = $client->call('recibir', $param_ws);

//                echo "<pre>RESPUESTA<br/>";
//                    print_r($response);
//                    exit();
                
                if(!$client->getError()){
                    

                    
                    
                    $tipo['class']=$param['class'];
                    $tipo['function']='respuesta_recepcion_notificacion';

                    $parametros = '';
                    $traza = trustedServer::decrypt($response['traza']);
                    $parametros = $traza['parametros'];

//                        echo "<pre>";
//                        print_r($parametros);
//                        print_r($traza);
//                        exit();
    //                    
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
                    
//                        echo "<pre>";
//                        print_r($data_responce);
//                        exit();

                    $data_notify = $data_responce['notify'];
                    if($data_notify['status']=='ok'){
                        $interoperabilidad_enviada->setStatus('R');
                        $interoperabilidad_enviada->save();
                        
                        $parametros_adicionales = $data_responce['content'];
                        $parametros_adicionales = $parametros_adicionales['param'];
                        $parametros = array_merge($parametros, $parametros_adicionales);
                        $interoperabilidad_recibida->setParametros(sfYAML::dump($parametros));
                        $interoperabilidad_recibida->save();
                        
                        echo "<div style='position: absolute; top: -15px; left: 70px;'><img src='/images/icon/tick.png'/></div><br/>".$data_notify['message'];
                        $servicio_publicado_confianza->setNotificacion(true);
                        $servicio_publicado_confianza->save();
                    } else {
                        echo "<div style='position: absolute; top: -15px; left: 70px;'><img src='/images/icon/error.png'/></div><br/>".$data_notify['message'];
                        $servicio_publicado_confianza->setNotificacion(false);
                        $servicio_publicado_confianza->save();
                    }

//                    echo "<pre>";
//                    print_r($data_content);
//                    exit();
                    
                } else {
                    echo "<img src='/images/icon/error.png'/> Error al conectar con el servidor, posiblemente este inactivo.";
                }
            }
        }

        exit();
    }
}
