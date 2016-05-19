<?php

class SignSiglas {
    static function desempaquetar($paquete_crypt) {
        $certs = array();
        $file_name_base = date('Ymdhis');
        $file_crypt = sfConfig::get("sf_root_dir").'/config/io/kawi/'.$file_name_base.'_crypt.txt';
        $file_decrypt = sfConfig::get("sf_root_dir").'/config/io/kawi/'.$file_name_base.'_decrypt.txt';
        
        $pkcs12 = file_get_contents(sfConfig::get("sf_root_dir").'/config/io/c2.p12');
        openssl_pkcs12_read($pkcs12, $certs, "123456");
        $cert = $certs['cert'];
        $pkey = $certs['pkey'];
        
        // Se lee el certificado del destinatario del mensaje
        $cert_x509 = openssl_x509_read($cert);
        
        $certID=openssl_get_publickey($cert);
        $pkeyID=openssl_get_privatekey($pkey);

$paquete_crypt = 'MIME-Version: 1.0
Content-Disposition: attachment; filename="smime.p7m"
Content-Type: application/x-pkcs7-mime; smime-type=enveloped-data; name="smime.p7m"
Content-Transfer-Encoding: base64

'.$paquete_crypt;


        file_put_contents($file_crypt, $paquete_crypt);
        file_put_contents($file_decrypt, '');

        openssl_pkcs7_decrypt($file_crypt,$file_decrypt,$cert_x509,$pkeyID);

        // Liberación del certificado y la clave
        openssl_x509_free($cert_x509);
        openssl_pkey_free($pkeyID);
      
      
        $paquete_decrypt = file_get_contents($file_decrypt);
      
        unlink($file_crypt);
        unlink($file_decrypt);
        
        $proteccion='';
        if($paquete_decrypt){
            $paquete_decrypt = new SimpleXMLElement($paquete_decrypt);

            $headers = (array) $paquete_decrypt->Headers;
            $header=array();
            $i=0;
            foreach ($headers as $valor) {
                $valor_array = (array)$valor;
                foreach ($valor_array as $ids) {
                    $ids_array = (array) $ids;
                    $header[$ids_array['idHeader']] = $ids_array['Value'];
                }
            }

            $signatures = (array) $paquete_decrypt->Signatures;
            $signature=array();
            $i=0;
            foreach ($signatures as $valor) {
                $signature_array = (array)$valor;
                $signature[$signature_array['signatureID']]['signature'] = $signature_array['signatureData'];
                $signature[$signature_array['signatureID']]['date'] = $signature_array['signatureDate'];
            }

            $proteccion['header'] = $header;
            $proteccion['signature'] = $signature;
        }
        return $proteccion;
    }
    
    static function verificarIntegridad($paquete_sign) {
        // LOS LLAMADOS A FIRMAS DE JAVA SON DIFERENTES A LOS DE PHP
        // AQUI EL LISTADO http://php.net/manual/es/function.openssl-get-md-methods.php
        if($paquete_sign['algoritmo_firma'] == 'SHA256withRSA'){
            $paquete_sign['algoritmo_firma'] = 'sha256WithRSAEncryption';
        }
//        print_r($paquete_sign['firma']);
//        
//        $paquete_sign['firma'] = str_replace('-----BEGIN BASIC SIGNATURE-----', '', $paquete_sign['firma']);
//        $paquete_sign['firma'] = str_replace('-----END BASIC SIGNATURE-----', '', $paquete_sign['firma']);
//        $paquete_sign['firma'] = base64_decode($paquete_sign['firma']);
//        echo '<hr>';
//        print_r($paquete_sign['firma']);
        
        $result_sign = openssl_verify($paquete_sign['data'], $paquete_sign['firma'], $paquete_sign['certificado'], $paquete_sign['algoritmo_firma']);
        
        return $result_sign;
    }
}

?>
