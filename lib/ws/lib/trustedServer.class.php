<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of confianza
 *
 * @author ProSoft Solutions Venezuela C.A.
 */
class trustedServer {
    static function encrypt($dominio,$array_data) {
        // ABRIR ARCHIVO DE LLAVE PUBLICA DEL CLIENTE DEL WS PARA VERIFICAR FIRMA (CLIENTE DE CONFIANZA)
        $PK_public_client = trustedServer::openPublicKey($dominio);
        if(isset($PK_public_client['error'])){
            return $PK_public_client;
        }

        
        // SERIALIZAMOS POR SI SE ENCRIPTA UN ARRAY
        $encript_array = urlencode(serialize($array_data));
        
        // SE PROCEDE A PICAR EL TEXTO A ENCRIPTAR YA QUE EL TEXTO A ENCRIPTAR DEBE SER MENOR A LA CLAVE (CERTIFICADO)
        $x = 0; $i=0; $corte=110;
        $encript_array_corte = array();

        while($x<=strlen($encript_array)){
            $encript_array_corte[$i]=  substr($encript_array, $x, $corte);

            // ENCRIPTAR EL ARRAY CONDUCTORES CON LLAVE PUBLICA DEL CLIENTE
            $array_crypt="";

            openssl_public_encrypt($encript_array_corte[$i],$array_crypt,$PK_public_client['crt']);

            if (!empty($array_crypt)) {
                // APLICAR URLCODE A LOS DATOS ENCRIPTADOS
                $result[$i]=urlencode($array_crypt);
            }else{
                openssl_free_key($PK_public_client['crt']);
                
                $result['error'] = "ERROR AL MOMENTO DE ENCRIPTAR LA RESPUESTA DEL WS, NOTIFICAR ESTE EVENTO";
                return $result;
            }

            $i++;
            $x+=$corte;
        }
        
        return $result;
    }
    
    static function encryptAndSing($dominio,$array_data) {
        $encript_array = urlencode(serialize($array_data));
        
        // ABRIR ARCHIVO DE LLAVE PUBLICA DEL CLIENTE DEL WS PARA VERIFICAR FIRMA (CLIENTE DE CONFIANZA)
        $PK_public_client = trustedServer::openPublicKey($dominio);
        if(isset($PK_public_client['error'])){
            return $PK_public_client;
        }
        
        // ABRIR ARCHIVO DE LLAVE PRIVADA DEL SERVIDOR DEL WS PARA DESENCRIPTAR
        $PK_private_server = trustedServer::openPrivateKey();
        
        // FIRMAR CONTENIDO COMPLETO
        $firma_servidor="";
        openssl_sign($encript_array, $firma_servidor, $PK_private_server, OPENSSL_ALGO_SHA1);
        $firma_servidor = urlencode($firma_servidor);

        $result['sing'] = $firma_servidor;
        
        // SE PROCEDE A PICAR EL TEXTO A ENCRIPTAR YA QUE EL TEXTO A ENCRIPTAR DEBE SER MENOR A LA CLAVE (CERTIFICADO)
        $x = 0; $i=0; $corte=110;
        $encript_array_corte = array();

        while($x<=strlen($encript_array)){
            $encript_array_corte[$i]=  substr($encript_array, $x, $corte);

            // ENCRIPTAR EL ARRAY CONDUCTORES CON LLAVE PUBLICA DEL CLIENTE
            $array_crypt="";

            openssl_public_encrypt($encript_array_corte[$i],$array_crypt,$PK_public_client['crt']);

            if (!empty($array_crypt)) {
                // APLICAR URLCODE A LOS CONDUCTORES ENCRIPTADOS
                $result['data'][$i]=urlencode($array_crypt);
            }else{
                // LIBERAR CACHE DE CERTIFICADO
                openssl_free_key($PK_private_server);
                openssl_free_key($PK_public_client['crt']);
                
                $result['error'] = "ERROR AL MOMENTO DE ENCRIPTAR LA RESPUESTA DEL WS, NOTIFICAR ESTE EVENTO";
                return $result;
            }

            $i++;
            $x+=$corte;
        }
        
        openssl_public_encrypt(sfConfig::get('sf_dominio'),$imme_crypt,$PK_public_client['crt']);
        $result['iam'] = urlencode($imme_crypt);
        // LIBERAR CACHE DE CERTIFICADO
        openssl_free_key($PK_private_server);
        openssl_free_key($PK_public_client['crt']);
    
        return $result;
    }
    
    static function decrypt($data) {
        // ABRIR ARCHIVO DE LLAVE PRIVADA DEL SERVIDOR DEL WS PARA DESENCRIPTAR
        $PK_private_server = trustedServer::openPrivateKey();
        
        // REARMAMOS LA CADENA DEVUELTA COMO UN ARRAY DE CONTENIDOS ENCRIPTADOS
        $full_Decrypted='';
        foreach ($data as $part_crypt) {
            // ELIMINAR URLCODE DEL CADA POSICION DEL ARRAY
            $part_crypt = urldecode($part_crypt);
            
            // DESENCRIPTAMOS CADA POSICION DEL ARRAY
            $Crypted=openssl_private_decrypt($part_crypt,$Decrypted_resultado,$PK_private_server);
            
            if (!$Crypted) {
                return "ERROR AL DESENCRIPTAR RESPUESTA DEL SERVIDOR WS";
            }else{
                // CONCATENAR VALOR DESENCRIPTADO A LA CADENA COMPLETA
                $full_Decrypted .= $Decrypted_resultado;
            }
            
        }
        
        // DESERIALIZAMOS LA DATA DESENCRIPTADA POR SI FUE UN ARRAY
        $decrypted_data = unserialize(urldecode($full_Decrypted));
        
        return $decrypted_data;
    }
    
    static function verifyAndDecrypt($data) {
        // ELIMINAR URLCODE DE LA FIRMA
        $sing = urldecode($data['sing']);
        $iam = urldecode($data['iam']);
        
        // ABRIR ARCHIVO DE LLAVE PRIVADA DEL SERVIDOR DEL WS PARA DESENCRIPTAR
        $PK_private_server = trustedServer::openPrivateKey();
        
        // DESENCRIPTAMOS EL I'M ME DEL EMISOR (SOLICITANTE WS)
        $Crypted=openssl_private_decrypt($iam,$Decrypted_iam,$PK_private_server);
        


        if (!$Crypted) {
            return "ERROR AL DESENCRIPTAR RESPUESTA DEL SERVIDOR WS";
        }else{
            // ABRIR ARCHIVO DE LLAVE PUBLICA DEL CLIENTE DEL WS PARA VERIFICAR FIRMA (CLIENTE DE CONFIANZA)
            $PK_public_client = trustedServer::openPublicKey($Decrypted_iam);
        }
        
        // REARMAMOS LA CADENA DEVUELTA COMO UN ARRAY DE CONTENIDOS ENCRIPTADOS
        $full_Decrypted='';
        foreach ($data['data'] as $part_crypt) {
            // ELIMINAR URLCODE DEL CADA POSICION DEL ARRAY
            $part_crypt = urldecode($part_crypt);
            
            // DESENCRIPTAMOS CADA POSICION DEL ARRAY
            $Crypted=openssl_private_decrypt($part_crypt,$Decrypted_resultado,$PK_private_server);
            
            if (!$Crypted) {
                return "ERROR AL DESENCRIPTAR RESPUESTA DEL SERVIDOR WS";
            }else{
                // CONCATENAR VALOR DESENCRIPTADO A LA CADENA COMPLETA
                $full_Decrypted .= $Decrypted_resultado;
            }
            
        }

        // VERIFICAR AUTENTICIDAD DE LA SOLICITUD
        $result_sign = openssl_verify($full_Decrypted, $sing, $PK_public_client['crt'], "sha1WithRSAEncryption");

        // LIBERAR CACHE DE CERTIFICADO
        openssl_free_key($PK_private_server);
        openssl_free_key($PK_public_client['crt']);

        if($result_sign==1){
            $data = array();
            $data = unserialize(urldecode($full_Decrypted));

            $data['param']['dominio'] = $Decrypted_iam;
            $data['param']['heis'] = $PK_public_client['heis'];
            $data['param']['confianza_id']=$PK_public_client['confianza_id'];
            $data['param']['crt_id'] = $PK_public_client['crt_id'];

            return $data;
        } else {
            return FALSE;
        }
    }
    
    static function openPrivateKey(){
        // ABRIR ARCHIVO DE LLAVE PRIVADA DEL SERVIDOR DEL WS PARA DESENCRIPTAR
        $fp=fopen (sfConfig::get("sf_root_dir").'/config/io/siglas_private.crt','r');

        // EXTRAER LLAVE PRIVADA Y DETALLES
        $priv_key=fread ($fp,8192);
        fclose($fp);
        $PK_private_server="";
        $PK_private_server=openssl_get_privatekey($priv_key);
        
        return $PK_private_server;
    }
    
    static function extracMyCertificate(){
        // ABRIR ARCHIVO DE LLAVE PUBLICA DE MI SIGLAS
        $fp=fopen (sfConfig::get("sf_root_dir").'/config/io/siglas_public.crt','r');

        // EXTRAER LLAVE PUBLICA Y DETALLES
        $pub_key=fread ($fp,8192);
        fclose($fp);
        
        return $pub_key;
    }
    
    static function openPublicKey($dominio){
        // ABRIR ARCHIVO DE LLAVE PUBLICA DEL CLIENTE DEL WS PARA VERIFICAR FIRMA (CLIENTE DE CONFIANZA)

        $servidor_certificado = Doctrine_Query::create()
                    ->select("scer.certificado, scon.id as confianza_id, scon.organismo_id as organismo_id")
                    ->from('Siglas_ServidorCertificado scer')    
                    ->innerJoin('scer.Siglas_ServidorConfianza scon')
                    ->where('scon.dominio = ?',$dominio)
                    ->andWhere('scon.status = ?','A')
                    ->andWhere('scer.status = ?','A')
                    ->execute();

        if(count($servidor_certificado)>0){
            if($servidor_certificado[0]->getCertificado()){
                // EXTRAER CERTIFICADO Y DETALLES
                $PK_public_client="";
                $PK_public_client['heis']=$servidor_certificado[0]->getOrganismoId();
                $PK_public_client['confianza_id']=$servidor_certificado[0]->getConfianzaId();
                $PK_public_client['crt']=openssl_get_publickey($servidor_certificado[0]->getCertificado());
                $PK_public_client['crt_id']=$servidor_certificado[0]->getId();
            } else {
                $PK_public_client['error'] = 'EL SERVIDOR DE CONFIANZA NO TIENE UN CERTIFICADO ACTIVO';
            }
        } else {
            $PK_public_client['error'] = 'NO EXISTE CONFIANZA CON EL ORGANISMO CON QUE SE DESEA REALIZAR INTEROPERABILIDAD';
        }
        
        return $PK_public_client;
    }
}
