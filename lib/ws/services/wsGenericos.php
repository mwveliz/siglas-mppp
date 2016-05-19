<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsGenericos
 *
 * @author livio
 */
class wsGenericos {    
    public function datosCedula($data){

            $cedula = $data['content']['cedula'];
            
            try{
                  $manager = Doctrine_Manager::getInstance()
                          ->openConnection('pgsql://postgres:123456@127.0.0.1/saime', 'dbSAIME');

                  $query = "SELECT dnacionalidad, ccedula, dnombre_1, dnombre_2, dapellido_1, dapellido_2, ffecha_nac
                            FROM tciudadano 
                            WHERE ccedula = '".$cedula."'
                            LIMIT 1";

                  $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                  if ($result) {
                      $persona['cedula'] = $result[0]['ccedula'];
                      $persona['primer_nombre'] = ucwords(strtolower($result[0]['dnombre_1']));
                      $persona['segundo_nombre'] = ucwords(strtolower($result[0]['dnombre_2']));
                      $persona['primer_apellido'] = ucwords(strtolower($result[0]['dapellido_1']));
                      $persona['segundo_apellido'] = ucwords(strtolower($result[0]['dapellido_2']));
                      $persona['f_nacimiento'] = date("Y-m-d", strtotime($result[0]['ffecha_nac']));
                  } else {
                      $persona['error'] = 'No se encontro la cedula solicitada';
                  }

                  Doctrine_Manager::getInstance()->closeConnection($manager);
            } catch (Exception $e) {}
      
        
        return $persona;
    }
    
    public function datosVehiculo($data){

        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['param']['dominio']);
        
        if($servidor_confianza){
            $placa = $data['content']['placa'];
            
            try{
                  $manager = Doctrine_Manager::getInstance()
                          ->openConnection('pgsql://postgres:123456@127.0.0.1/intt_prueba_ws', 'dbINTT');

                  $query = "SELECT marca, modelo, placa, serial_motor, serial_carroceria, color, anio
                            FROM vehiculo 
                            WHERE placa = '".$placa."'
                            LIMIT 1";

                  $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                  if ($result) {
                      $vehiculo['marca'] = $result[0]['marca'];
                      $vehiculo['modelo'] = $result[0]['modelo'];
                      $vehiculo['placa'] = $result[0]['placa'];
                      $vehiculo['serial_motor'] = $result[0]['serial_motor'];
                      $vehiculo['serial_carroceria'] = $result[0]['serial_carroceria'];
                      $vehiculo['color'] = $result[0]['color'];
                      $vehiculo['anio'] = $result[0]['anio'];
                  } else {
                      $vehiculo['error'] = 'No se encontro la placa solicitada';
                  }

                  Doctrine_Manager::getInstance()->closeConnection($manager);
            } catch (Exception $e) {}
      

        }
        
        return $vehiculo;
    }
    
    public function reporteVehiculo($data){

        $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['param']['dominio']);
        
        if($servidor_confianza){
            $placa = $data['content']['placa'];
            
            try{
                  $manager = Doctrine_Manager::getInstance()
                          ->openConnection('pgsql://postgres:123456@127.0.0.1/cicpc_prueba_ws', 'dbINTT');

                  $query = "SELECT solicitado
                            FROM vehiculo_solicitado 
                            WHERE placa = '".$placa."'
                            AND solicitado = TRUE
                            LIMIT 1";

                  $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);

                  if ($result) {
                      $vehiculo['solicitado'] = 'S';
                  } else {
                      $vehiculo['solicitado'] = 'N';
                  }

                  Doctrine_Manager::getInstance()->closeConnection($manager);
            } catch (Exception $e) {}
      

        }
        
        return $vehiculo;
    }
}