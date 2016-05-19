<?php
class Formateo {
    static function cargo($unidad_armar,$cargo_armar) {
        // ARMADO DE CARGO
        $unidad_explode = explode(' ', $unidad_armar);

        $menor=4; $key_replace='';
        foreach ($unidad_explode as $key => $palabra_cargo) {
            $x = levenshtein(trim($palabra_cargo), trim($cargo_armar));
            if($x <= 4 && $x <= $menor) {
                $menor = $x;
                $key_replace = trim($palabra_cargo);
            }
            
//            $key['palabra'] = $palabra_cargo;
//            $key['distancia'] = $x;
//            $key['key_me'] = $key;
//            $key['key_replace'] = $key_replace;
        }

        if($key_replace==''){
            $cargo = $cargo_armar.' de '.$unidad_armar;
        } else {
            $cargo = str_replace($key_replace, $cargo_armar, $unidad_armar);
        }
        
        return $cargo;
    }
    
    static function prefijo_unidad($unidad_analizar,$tipo=1) {        
        $unidad_primera_palabra = explode(' ', $unidad_analizar);
        $unidad_primera_palabra = $unidad_primera_palabra[0];
        
        $unidad_primera_palabra = strtolower($unidad_primera_palabra);
        $vowels = array("a", "A", "á", "Á", "à", "À");
        $unidad_primera_palabra = str_replace($vowels, 'a', $unidad_primera_palabra);
        $vowels = array("e", "E", "é", "É", "è", "È");
        $unidad_primera_palabra = str_replace($vowels, 'e', $unidad_primera_palabra);
        $vowels = array("i", "I", "í", "Í", "ì", "Ì");
        $unidad_primera_palabra = str_replace($vowels, 'i', $unidad_primera_palabra);
        $vowels = array("o", "O", "ó", "Ó", "ò", "Ò");
        $unidad_primera_palabra = str_replace($vowels, 'o', $unidad_primera_palabra);
        $vowels = array("u", "U", "ú", "Ú", "ù", "Ù", "ü", "Ü");
        $unidad_primera_palabra = str_replace($vowels, 'u', $unidad_primera_palabra);

        $primera_palabra = array();
        $prefijo = array();
        
        /*############################################*/
        $indice = 0;
        $primera_palabra[$indice]=array('presidencia');
        $prefijo[1][$indice] = 'a la';
        $prefijo[2][$indice] = 'de';
        
        $indice = 1;
        $primera_palabra[$indice]=array('oficina','coordinacion','area');
        $prefijo[1][$indice] = 'a la';
        $prefijo[2][$indice] = 'de la';
        
        $indice = 2;
        $primera_palabra[$indice]=array('departamento','despacho','viceministerio','ministerio');
        $prefijo[1][$indice] = 'a el';
        $prefijo[2][$indice] = 'del';
        
        for ($i=0;$i<count($primera_palabra);$i++){
            if(in_array($unidad_primera_palabra,$primera_palabra[$i])) {
                return $prefijo[$tipo][$i];
            }   
        }
    }
}