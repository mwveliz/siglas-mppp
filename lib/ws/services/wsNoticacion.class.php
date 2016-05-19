<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsNotificacion
 *
 * @author livio
 */
class wsNotificacion {        
    public function recibirServicioDisponible($data){
//        $response['notify']['status']='ok';
//        return $data['content'];
        
        $servicio_disponible_old = Doctrine::getTable('Siglas_ServiciosDisponibles')->findOneByServidorConfianzaIdAndFuncionAndStatus($data['param']['confianza_id'],$data['content']['funcion'],'A');

        if($servicio_disponible_old){
            $existe = true;
        } else {
            $existe = false;
        }
        
        $servicio_disponible = new Siglas_ServiciosDisponibles();
        $servicio_disponible->setServidorConfianzaId($data['param']['confianza_id']);
        $servicio_disponible->setFuncion($data['content']['funcion']);
        $servicio_disponible->setDescripcion($data['content']['descripcion']);
        $servicio_disponible->setTipo($data['content']['tipo']);
        $servicio_disponible->setCrontab($data['content']['crontab']);
        $servicio_disponible->setRecursos($data['content']['recursos']);
        $servicio_disponible->setParametrosEntrada($data['content']['parametros_entrada']);
        $servicio_disponible->setParametrosSalida($data['content']['parametros_salida']);
        $servicio_disponible->save();

        $file_base64 =  $data['content']['files'][0];
        $file_name = $servicio_disponible->getRecursos();
        $file_ruta = sfConfig::get('sf_upload_dir').'/interoperabilidad/recursos_externos';

        $file_name_old='..';
        if (file_exists ($file_ruta."/".$file_name)){
            $file_name_old = $file_name.".".date('Y-m-d_h-i-s').".ID-".$servicio_disponible_old->getId().".old";

            if (!copy($file_ruta."/".$file_name, $file_ruta."/".$file_name_old)) {
                unlink($file_ruta."/".$file_name);
            }

//            $servicios_disponibles_old = Doctrine::getTable('Siglas_ServiciosDisponibles')->findByRecursosAndStatus($servicio_disponible->getRecursos(),'I');
//
//            foreach ($servicios_disponibles_old as $servicio_disponible_old) {
//                $servicio_disponible_old->setRecursos($file_name_old);
//                $servicio_disponible_old->save();
//            }
        }
        @file_put_contents($file_ruta."/".$file_name,base64_decode($file_base64));
        
        if($servicio_disponible_old){
            $servicio_disponible_old->setRecursos($file_name_old);
            $servicio_disponible_old->setStatus('I');
            $servicio_disponible_old->save();
        }
            
        if($existe == false){
            $response['notify']['status']='ok';
            $response['notify']['message']='Notificacion recibida. Se registro correctamente el servicio publicado en el cliente.';
            
            $response['content']['param']['servicio_disponible_id'] = $servicio_disponible->getId();

        } else {
            // REPUESTA EN CASO DE NO TENER ACCESO AL SERVICIO
            $response['notify']['status']='ok';
            $response['notify']['message']='Notificacion recibida, sin embargo ya se encontraba registrado el servicio como disponible.';
            $response['content']['param']['servicio_disponible_id'] = $servicio_disponible->getId();
        }
        
        return $response;
    }
}