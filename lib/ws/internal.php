<?php
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('acceso', '', true);
sfContext::createInstance($configuration);

require_once(sfConfig::get("sf_root_dir").'/lib/ws/nusoap/nusoap.php');



$server = new soap_server();

$namespace = "http://".sfConfig::get('sf_dominio')."/ws.php";
$server->configureWSDL('WS SIGLAS',$namespace);
$server->wsdl->schematargetnamespace=$namespace;

function recibir($data){
    // VERIFICAR CONFIANZA
    $confianza = trustedServer::verifyAndDecrypt($data);

    if($confianza){
        // SI EL SERVIDOR ES DE CONFIANZA COMIENZA PROCESO DE APERTURA DE DATA
//        $data_good = unserialize(urldecode($confianza));
        $data_good = $confianza;
//        return $data_good;
        $ws_class = ucfirst($data_good['param']['class']);
        $ws_function = $data_good['param']['function'];
        
        $tipo['class']=$ws_class;
        $tipo['function']=$ws_function;
        
        $traza = trustedServer::decrypt($data['traza']);
//        return $traza;
//                    $sfprueba = sfYAML::dump($traza);
//                    file_put_contents(sfConfig::get("sf_root_dir").'/config/siglas/ws.yml', $sfprueba);
//                    exit();
        $parametros = $traza['parametros'];
        
        // REGISTRAMOS TRAZA DE RECEPCION DE DATOS DE INTEROPERABILIDAD
        $interoperabilidad_recibida = new Siglas_InteroperabilidadRecibida();
        $interoperabilidad_recibida->setServidorConfianzaId($data_good['param']['confianza_id']);
        $interoperabilidad_recibida->setServidorCertificadoId($data_good['param']['crt_id']);
        $interoperabilidad_recibida->setTipo(sfYAML::dump($tipo));
        $interoperabilidad_recibida->setFirma($data['sing']);
        $interoperabilidad_recibida->setCadena(sfYAML::dump($data['data']));
        $interoperabilidad_recibida->setPaquete($traza['paquete']);
        $interoperabilidad_recibida->setPartes($traza['partes']);
        $interoperabilidad_recibida->setParte($traza['parte']);
        $interoperabilidad_recibida->setParametros(sfYAML::dump($parametros));
        $interoperabilidad_recibida->save();
//exit();

        // SETEAMOS EL ID DE LA TRAZA PARA USO INTERNO DE LAS TRANSACCIONES EJECUTADAS EN LA FUNCION LLAMADA
        $data_good['param']['interoperabilidad_recibida_id'] = $interoperabilidad_recibida->getId();
                
        // REDIRECCIONAMOS DINAMICAMENTE AL SERVICIO SOLICITADO LA DATA DESENCRIPTADA Y VERIFICADA
        eval('$servicio = new ws'.$ws_class.'();');
        eval('$servicio = $servicio->'.$ws_function.'($data_good);');
        
        // ENCRIPTAR Y FIRMAR RESPUESTA
        $responce_sing_and_crypt = trustedServer::encryptAndSing($data_good['param']['dominio'],$servicio);
        
        $tipo['class']=$ws_class;
        $tipo['function']='respuesta_enviada';
        
        // REGISTRAMOS LA TRAZA DE ENVIO DE LA RESPUESTA
        $interoperabilidad_enviada = new Siglas_InteroperabilidadEnviada();
        $interoperabilidad_enviada->setServidorConfianzaId($data_good['param']['confianza_id']);
        $interoperabilidad_enviada->setServidorCertificadoId($data_good['param']['crt_id']);
        $interoperabilidad_enviada->setInteroperabilidadRecibidaId($interoperabilidad_recibida->getId());
        $interoperabilidad_enviada->setTipo(sfYAML::dump($tipo));
        $interoperabilidad_enviada->setFirma($responce_sing_and_crypt['sing']);
        $interoperabilidad_enviada->setCadena(sfYAML::dump($responce_sing_and_crypt['data']));
        $interoperabilidad_enviada->setPaquete(strtotime(date('Y-m-d H:i:s')));
        $interoperabilidad_enviada->setPartes(1);
        $interoperabilidad_enviada->setParte(1);
        $interoperabilidad_enviada->setStatus('R');
        $interoperabilidad_enviada->setParametros(sfYAML::dump($servicio['content']));
        $interoperabilidad_enviada->save();
        // SETEAR COMO PARAMETRO EL ID DE LA CORREPONDENCIA CUANDO SE REGISTRA AL RECIBIRLA
        // SETEAR COMO PARAMETRO EL ID DE LA CORREPONDENCIA
        // SETEAR COMO PARAMETRO EL ID DE LA CORREPONDENCIA
        // SETEAR COMO PARAMETRO EL ID DE LA CORREPONDENCIA
        // SETEAR COMO PARAMETRO EL ID DE LA CORREPONDENCIA

        $interoperabilidad_enviada->setPaquete($interoperabilidad_enviada->getId());
        $interoperabilidad_enviada->save();
        

//        return $servicio;
        // RETORNO DEL IDS DE TRAZA
        $traza = array();
        $traza['parametros'] = $servicio['content'];
        $traza['parametros']['interoperabilidad_recepcion_solicitud_id']=$interoperabilidad_recibida->getId();
        $traza['parametros']['interoperabilidad_envio_respuesta_id'] = $interoperabilidad_enviada->getId();
        $traza['paquete'] = $interoperabilidad_enviada->getId();
        $traza['partes'] = 1;
        $traza['parte'] = 1;
        
        // ENCRIPTAMOS TRAZA
        $traza_crypt = trustedServer::encrypt($data_good['param']['dominio'],$traza);

        // INCORPORAMOS INFROMACION DE LA TRAZA AL ENVIO
        $responce_sing_and_crypt['traza'] = $traza_crypt;
        
                
        return $responce_sing_and_crypt;
    } else {
        return 'EL SERVIDOR NO ES DE CONFIANZA, HA FALLADO LA VERIFICACION DE FIRMA ELECTRONICA';
    }
}

function aparear($data){
    
    // SI EL SERVIDOR ES DE CONFIANZA COMIENZA PROCESO DE APERTURA DE DATA
    $data = unserialize(urldecode($data));

    $servicio = new wsAparear();
    $servicio = $servicio->recibirConfianza($data);

    return $servicio;
}

$server->register(
                // METODO
                'recibir',
                // PARAMETROS RECIBIDOS
                array('data'=>'xsd:Array'),
                // PARAMETROS RETORNO
                array('return'=>'xsd:Array'),
                // NAMESPACE
                $namespace);

$server->register(
                // METODO
                'aparear',
                // PARAMETROS RECIBIDOS
                array('data'=>'xsd:Array'),
                // PARAMETROS RETORNO
                array('return'=>'xsd:Array'),
                // NAMESPACE
                $namespace);

//require_once(sfConfig::get("sf_root_dir").'/lib/ws/servicios/correspondencia.php');



if(isset($HTTP_RAW_POST_DATA)){
    $input = $HTTP_RAW_POST_DATA;
} else {
    $input = implode("rm", file('php://input'));
}

$server->service($input);
exit();
?>


