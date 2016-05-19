<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wsAparear
 *
 * @author livio
 */
class wsAparear {
    public function recibirConfianza($data){
        $ssl_open = openssl_x509_parse($data['certificado']);
        $result = array();
                
        $conn = Doctrine_Manager::connection();
        $conn->beginTransaction();
        try {
            $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['dominio']);
            
            if(!$servidor_confianza){
                $sf_interoperabilidad = sfYaml::load(sfConfig::get("sf_root_dir")."/config/siglas/interoperabilidad.yml");
                foreach ($sf_interoperabilidad as $key => $servidor) {
                    $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($servidor['dominio']);

                    if(!$servidor_confianza){
                        $organismo = new Organismos_Organismo();
                        $organismo->setNombre($servidor['nombre']);
                        $organismo->setSiglas($servidor['siglas']);
                        $organismo->setTelfUno($servidor['telf_uno']);
                        $organismo->setTelfDos($servidor['telf_dos']);
                        $organismo->setEmailPrincipal($servidor['email']);
                        $organismo->save();


                        $servidor_confianza = new Siglas_ServidorConfianza();
                        $servidor_confianza->setOrganismoId($organismo->getId());
                        $servidor_confianza->setDominio($servidor['dominio']);
                        $servidor_confianza->setStatus('A');
                        $servidor_confianza->save();
                    }
                }
                $servidor_confianza = null;
                $servidor_confianza = Doctrine::getTable('Siglas_ServidorConfianza')->findOneByDominio($data['dominio']);
            }

            if($servidor_confianza){
                $servidor_confianza->setStatus('A');
                $servidor_confianza->save();

                //se debe inactivar todos los certificados encontrado e insertar el nuevo
                $inactivar_crt_anteriores = Doctrine_Query::create()
                    ->update('Siglas_ServidorCertificado')
                    ->set('status','?', 'I')
                    ->where('servidor_confianza_id = ?', $servidor_confianza->getId())
                    ->execute();
            
                $servidor_certificado = Doctrine::getTable('Siglas_ServidorCertificado')->findOneByServidorConfianzaIdAndCertificado($servidor_confianza->getId(),$data['certificado']);

                if(!$servidor_certificado){
                    $servidor_certificado = new Siglas_ServidorCertificado();
                    $servidor_certificado->setServidorConfianzaId($servidor_confianza->getId());
                    $servidor_certificado->setCertificado($data['certificado']);
                    $servidor_certificado->setDetallesTecnicos(sfYAML::dump($ssl_open));
                    $servidor_certificado->setFValidoDesde(date('Y-m-d', $ssl_open['validFrom_time_t']));
                    $servidor_certificado->setFValidoHasta(date('Y-m-d', $ssl_open['validTo_time_t']));
                } else {
                    $servidor_certificado->setStatus('A');
                }
                
                $servidor_certificado->save();
                
                $conn->commit();
                
            } else {
                $conn->rollBack();
                $result['error'] = "ERROR AL MOMENTO DE REGISTRAR EL CERTIFICADO, AUN NO HEMOS RECIBIDO EL ARCHIVO DE INTEROPERABILIDAD QUE LO REGISTRA COMO SERVIDOR DE CONFIANZA.";
            }
        } catch (Doctrine_Validator_Exception $e) {
            $conn->rollBack();
            $result['error'] = "ERROR AL MOMENTO DE RECIBIR EL CERTIFICADO, POR FAVOR INTENTE DE NUEVO.";
        }
        
        if(!isset($result['error'])){
            $ws_array['dominio']=sfConfig::get('sf_dominio');

            $PK_certificate = trustedServer::extracMyCertificate();
            $ws_array['certificado'] = $PK_certificate;

            $result = urlencode(serialize($ws_array));
        }
        
        return $result;
    }
}