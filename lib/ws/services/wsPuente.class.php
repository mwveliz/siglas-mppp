<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsPuente
 *
 * @author livio
 */
class wsPuente {    
    public function prepararUnsetParametros($array,$padre,&$array_cadenas) {
        foreach ($array as $key => $value) {
            $index_name = $padre.'["'.$key.'"]';
            
            if(is_array($value)){
                $this->prepararUnsetParametros($value,$index_name,$array_cadenas);
            } else {
                if($value == false){
                    $array_cadenas[]=$index_name;
                }
            }
        }
    }
    
    public function frontera($data){
        // VERIFICACION QUE EL SERVICIO QUE ESTA SOLITANDO ESTA REGISTRADO Y ESTE CON ESTATUS ACTIVO
        $servicio_publicado = Doctrine::getTable('Siglas_ServiciosPublicados')->findOneByFuncionAndStatus($data['content']['function'],'A');
        
        if($servicio_publicado){
            // VERIFICACION DE ACCESO AL SERVICIO SOLICITADO
            $acceso_servicio = Doctrine::getTable('Siglas_ServiciosPublicadosConfianza')->findOneByServiciosPublicadosIdAndServidorConfianzaIdAndStatus($servicio_publicado->getId(),$data['param']['confianza_id'],'A');
            
            if($acceso_servicio){
                // URL DEL WS O SERVICIO QUE PUBLICAMOS EN ESTE SIGLAS
                $wsdl = $servicio_publicado->getUrl()."?wsdl";

                // INSTANCIAMOS EL WS
                $client = new nusoap_client($wsdl,'wsdl');

                // FORMATEO DE PARAMETROS
                $param = array('input'=>$data['content']['param']);

                // LLAMADO DEl SERVICIO PARA QUE LLENE LA VARIABLE $response
                $response = $client->call($data['content']['function'], $param);

                // ELIMINACION DE LOS DATOS CON ACCESO BLOQUEADO PARA EL ORGANISMO QUE SOLICITA
                $array_cadenas_unset = array();
                        
                $this->prepararUnsetParametros(sfYAML::load($acceso_servicio->getParametrosSalidaPermitidos()),'',$array_cadenas_unset); 

                foreach ($array_cadenas_unset as $cadena_unset) {
                    eval('unset($response["content"]'.$cadena_unset.');');
                }
            } else {
                // REPUESTA EN CASO DE NO TENER ACCESO AL SERVICIO
                $response['notify']['status']='error';
                $response['notify']['message']='Organismo sin acceso al servicio solicitado';
            }
        } else {
            // RESPUESTA EN CASO DE NO EXISTIR EL SERVICIO O ESTAR EN ESTATUS INACTIVO
            $response['notify']['status']='error';
            $response['notify']['message']='El servicio que esta solicitando no se encuentra activo o no esta registrado en nuestro SIGLAS.';
        }
        
        return $response;
    }
}