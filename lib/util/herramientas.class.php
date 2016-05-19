<?php

class herramientas {
    public function corteCache(){
    // funcion que te devuelve el lunes mas proximo hacia atras de la fecha actual
        $ano = date('Y'); $mes = date('m'); $dia = date('d');
        $actual = -1;

        while($actual!=1) {
            $actual = date('N', strtotime($ano.'-'.$mes.'-'.$dia));
            
            $x=''; if(strlen($dia)==1) $x='0';
            $fecha = $ano.'-'.$mes.'-'.$x.$dia;
            if($dia==1) {
                $dia = 31;
                if($mes==1){$mes=12; $ano--;} else {$mes--;}}
            else {$dia--;}} 

        $sf_cache = sfYaml::load("../config/siglas/cache.yml");
        $manager = Doctrine_Manager::getInstance();
        $cacheDriver = $manager->getAttribute(Doctrine_Core::ATTR_RESULT_CACHE);
        
        if($sf_cache['correspondencia']['ultimo_borrado']<$fecha)
        {
            $cacheDriver->deleteByPrefix('correspondencia_');
            $sf_cache['correspondencia']['ultimo_borrado']=$fecha;
        }
        
        $yaml = sfYAML::dump($sf_cache); 
        file_put_contents('../config/siglas/cache.yml', $yaml);
    }
    

    function limpiar_metas($string, $corte = null)
    {
        # paso los caracteres entities tipo &aacute; $gt;etc a sus respectivos html
        $s = html_entity_decode($string,ENT_COMPAT,'UTF-8');
        

        # quito todas las etiquetas html y php
        $s = strip_tags($s);
        # elimino todos los retorno de carro
        $s = str_replace("\r", '', $s);
        # en todos los espacios en blanco le añado un <br /> para después eliminarlo
        $s = preg_replace('/(?<!>)n/', "<br />n", $s);
        # elimino la inserción de nuevas lineas
        $s = str_replace("\n", '', $s);
        # elimino tabulaciones y el resto de la cadena
        $s = str_replace("\t", '', $s);
        # elimino caracteres en blanco
        $s = preg_replace('/[ ]+/', ' ', $s);
        $s = preg_replace('/<!--[^-]*-->/', '', $s);
        #elimino stylos de parrafo
        $s = preg_replace("/P {(.*?)}/i","",$s);
        $s = preg_replace("/P\.(.*?) {(.*?)}/i","",$s);
//        $s = preg_replace("/P\.ctl {(.*?)}/i","",$s);
//        $s = preg_replace("/P\.cjk {(.*?)}/i","",$s);
        $s = preg_replace("/A\:(.*?) {(.*?)}/i","",$s);
        # vuelvo a hacer el strip para quitar el <br /> que he añadido antes para eliminar las saltos de carro y nuevas lineas
        $s  = trim(strip_tags($s));
       
        if (isset($corte) && (is_numeric($corte))) { $s = mb_substr($s,0,$corte, 'UTF-8'); }

        return $s;
    }
    
    public function insensitiveSearch($word,$type='basic'){
        $vowels = array("a", "A", "á", "Á", "à", "À");
        $word = str_replace($vowels, '.#!1!#.', $word);
        $vowels = array("e", "E", "é", "É", "è", "È");
        $word = str_replace($vowels, '.#!2!#.', $word);
        $vowels = array("i", "I", "í", "Í", "ì", "Ì");
        $word = str_replace($vowels, '.#!3!#.', $word);
        $vowels = array("o", "O", "ó", "Ó", "ò", "Ò");
        $word = str_replace($vowels, '.#!4!#.', $word);
        $vowels = array("u", "U", "ú", "Ú", "ù", "Ù", "ü", "Ü");
        $word = str_replace($vowels, '.#!5!#.', $word);

//aAáÁàÀäÄâÂã
//eEéÉèÈëËêÊ
//iIíÍìÌïÏîÎ
//oOóÓòÒöÖôÔõÕ
//uUúÚùÙüÜûÛũŨ
        
        if($type == 'html')
        {
            $word = str_replace('.#!1!#.', '([aAáÁàÀ]|&aacute;|&Aacute;|&agrave;|&Agrave;)', $word);
            $word = str_replace('.#!2!#.', '([eEéÉèÈ]|&eacute;|&Eacute;|&egrave;|&Egrave;)', $word);
            $word = str_replace('.#!3!#.', '([iIíÍìÌ]|&iacute;|&Iacute;|&igrave;|&Igrave;)', $word);
            $word = str_replace('.#!4!#.', '([oOóÓòÒ]|&oacute;|&Oacute;|&ograve;|&Ograve;)', $word);
            $word = str_replace('.#!5!#.', '([uUúÚùÙüÜ]|&uacute;|&Uacute;|&ugrave;|&Ugrave;|&uuml;|&Uuml;)', $word);
        }
        else
        {
            $word = str_replace('.#!1!#.', '[aAáÁàÀ]', $word);
            $word = str_replace('.#!2!#.', '[eEéÉèÈ]', $word);
            $word = str_replace('.#!3!#.', '[iIíÍìÌ]', $word);
            $word = str_replace('.#!4!#.', '[oOóÓòÒ]', $word);
            $word = str_replace('.#!5!#.', '[uUúÚùÙüÜ]', $word);
        }
            
        return $word;
    }
    
    public function htmlRtf($word){
$word = str_replace("\n", '', $word);
$word = str_replace("\t", '', $word);
        
$word = str_replace("&quot;","\\u34\'3f",$word); // "
$word = str_replace("&amp;","\\u38\'3f",$word); // &
$word = str_replace("&lt;","\\u60\'3f",$word); // <
$word = str_replace("&gt;","\\u62\'3f",$word); // >
$word = str_replace("&nbsp;","\\u160\'3f",$word); //  
$word = str_replace("&iexcl;","\\u161\'3f",$word); // ¡
$word = str_replace("&cent;","\\u162\'3f",$word); // ¢
$word = str_replace("&pound;","\\u163\'3f",$word); // £
$word = str_replace("&curren;","\\u164\'3f",$word); // ¤
$word = str_replace("&yen;","\\u165\'3f",$word); // ¥
$word = str_replace("&brvbar;","\\u166\'3f",$word); // ¦
$word = str_replace("&sect;","\\u167\'3f",$word); // §
$word = str_replace("&uml;","\\u168\'3f",$word); // ¨
$word = str_replace("&copy;","\\u169\'3f",$word); // ©
$word = str_replace("&ordf;","\\u170\'3f",$word); // ª
$word = str_replace("&laquo;","\\u171\'3f",$word); // «
$word = str_replace("&not;","\\u172\'3f",$word); // ¬
$word = str_replace("&shy;","\\u173\'3f",$word); // ­
$word = str_replace("&reg;","\\u174\'3f",$word); // ®
$word = str_replace("&macr;","\\u175\'3f",$word); // ¯
$word = str_replace("&deg;","\\u176\'3f",$word); // °
$word = str_replace("&plusmn;","\\u177\'3f",$word); // ±
$word = str_replace("&sup2;","\\u178\'3f",$word); // ²
$word = str_replace("&sup3;","\\u179\'3f",$word); // ³
$word = str_replace("&acute;","\\u180\'3f",$word); // ´
$word = str_replace("&micro;","\\u181\'3f",$word); // µ
$word = str_replace("&para;","\\u182\'3f",$word); // ¶
$word = str_replace("&middot;","\\u183\'3f",$word); // ·
$word = str_replace("&cedil;","\\u184\'3f",$word); // ¸
$word = str_replace("&sup1;","\\u185\'3f",$word); // ¹
$word = str_replace("&ordm;","\\u186\'3f",$word); // º
$word = str_replace("&raquo;","\\u187\'3f",$word); // »
$word = str_replace("&frac14;","\\u188\'3f",$word); // ¼
$word = str_replace("&frac12;","\\u189\'3f",$word); // ½
$word = str_replace("&frac34;","\\u190\'3f",$word); // ¾
$word = str_replace("&iquest;","\\u191\'3f",$word); // ¿
$word = str_replace("&Agrave;","\\u192\'3f",$word); // À
$word = str_replace("&Aacute;","\\u193\'3f",$word); // Á
$word = str_replace("&Acirc;","\\u194\'3f",$word); // Â
$word = str_replace("&Atilde;","\\u195\'3f",$word); // Ã
$word = str_replace("&Auml;","\\u196\'3f",$word); // Ä
$word = str_replace("&Aring;","\\u197\'3f",$word); // Å
$word = str_replace("&AElig;","\\u198\'3f",$word); // Æ
$word = str_replace("&Ccedil;","\\u199\'3f",$word); // Ç
$word = str_replace("&Egrave;","\\u200\'3f",$word); // È
$word = str_replace("&Eacute;","\\u201\'3f",$word); // É
$word = str_replace("&Ecirc;","\\u202\'3f",$word); // Ê
$word = str_replace("&Euml;","\\u203\'3f",$word); // Ë
$word = str_replace("&Igrave;","\\u204\'3f",$word); // Ì
$word = str_replace("&Iacute;","\\u205\'3f",$word); // Í
$word = str_replace("&Icirc;","\\u206\'3f",$word); // Î
$word = str_replace("&Iuml;","\\u207\'3f",$word); // Ï
$word = str_replace("&ETH;","\\u208\'3f",$word); // Ð
$word = str_replace("&Ntilde;","\\u209\'3f",$word); // Ñ
$word = str_replace("&Ograve","\\u210\'3f",$word); // Ò
$word = str_replace("&Oacute;","\\u211\'3f",$word); // Ó
$word = str_replace("&Ocirc;","\\u212\'3f",$word); // Ô
$word = str_replace("&Otilde;","\\u213\'3f",$word); // Õ
$word = str_replace("&Ouml;","\\u214\'3f",$word); // Ö
$word = str_replace("&times;","\\u215\'3f",$word); // ×
$word = str_replace("&Oslash;","\\u216\'3f",$word); // Ø
$word = str_replace("&Ugrave;","\\u217\'3f",$word); // Ù
$word = str_replace("&Uacute;","\\u218\'3f",$word); // Ú
$word = str_replace("&Ucirc;","\\u219\'3f",$word); // Û
$word = str_replace("&Uuml;","\\u220\'3f",$word); // Ü
$word = str_replace("&Yacute;","\\u221\'3f",$word); // Ý
$word = str_replace("&THORN;","\\u222\'3f",$word); // Þ
$word = str_replace("&szlig;","\\u223\'3f",$word); // ß
$word = str_replace("&agrave;","\\u224\'3f",$word); // à
$word = str_replace("&aacute;","\\u225\'3f",$word); // á
$word = str_replace("&acirc;","\\u226\'3f",$word); // â
$word = str_replace("&atilde;","\\u227\'3f",$word); // ã
$word = str_replace("&auml;","\\u228\'3f",$word); // ä
$word = str_replace("&aring;","\\u229\'3f",$word); // å
$word = str_replace("&aelig;","\\u230\'3f",$word); // æ
$word = str_replace("&ccedil;","\\u231\'3f",$word); // ç
$word = str_replace("&egrave;","\\u232\'3f",$word); // è
$word = str_replace("&eacute;","\\u233\'3f",$word); // é
$word = str_replace("&ecirc;","\\u234\'3f",$word); // ê
$word = str_replace("&euml;","\\u235\'3f",$word); // ë
$word = str_replace("&igrave;","\\u236\'3f",$word); // ì
$word = str_replace("&iacute;","\\u237\'3f",$word); // í
$word = str_replace("&icirc;","\\u238\'3f",$word); // î
$word = str_replace("&iuml;","\\u239\'3f",$word); // ï
$word = str_replace("&eth;","\\u240\'3f",$word); // ð
$word = str_replace("&ntilde;","\\u241\'3f",$word); // ñ
$word = str_replace("&ograve;","\\u242\'3f",$word); // ò
$word = str_replace("&oacute;","\\u243\'3f",$word); // ó
$word = str_replace("&ocirc;","\\u244\'3f",$word); // ô
$word = str_replace("&otilde;","\\u245\'3f",$word); // õ
$word = str_replace("&ouml;","\\u246\'3f",$word); // ö
$word = str_replace("&divide;","\\u247\'3f",$word); // ÷
$word = str_replace("&oslash;","\\u248\'3f",$word); // ø
$word = str_replace("&ugrave;","\\u249\'3f",$word); // ù
$word = str_replace("&uacute;","\\u250\'3f",$word); // ú
$word = str_replace("&ucirc;","\\u251\'3f",$word); // û
$word = str_replace("&uuml;","\\u252\'3f",$word); // ü
$word = str_replace("&yacute;","\\u253\'3f",$word); // ý
$word = str_replace("&thorn;","\\u254\'3f",$word); // þ
$word = str_replace("&yuml;","\\u255\'3f",$word); // ÿ
$word = str_replace("&OElig;","\\u338\'3f",$word); // Œ
$word = str_replace("&oelig;","\\u339\'3f",$word); // œ
$word = str_replace("&Scaron;","\\u352\'3f",$word); // Š
$word = str_replace("&scaron;","\\u353\'3f",$word); // š
$word = str_replace("&Yuml;","\\u376\'3f",$word); // Ÿ
$word = str_replace("&circ;","\\u710\'3f",$word); // ˆ
$word = str_replace("&tilde;","\\u732\'3f",$word); // ˜
$word = str_replace("&ndash;","\\u8211\'3f",$word); // –
$word = str_replace("&mdash;","\\u8212\'3f",$word); // —
$word = str_replace("&lsquo;","\\u8216\'3f",$word); // ‘
$word = str_replace("&rsquo;","\\u8217\'3f",$word); // ’
$word = str_replace("&sbquo;","\\u8218\'3f",$word); // ‚
$word = str_replace("&ldquo;","\\u8220\'3f",$word); // “
$word = str_replace("&rdquo;","\\u8221\'3f",$word); // ”
$word = str_replace("&bdquo;","\\u8222\'3f",$word); // „
$word = str_replace("&dagger;","\\u8224\'3f",$word); // †
$word = str_replace("&Dagger;","\\u8225\'3f",$word); // ‡
$word = str_replace("&permil;","\\u8240\'3f",$word); // ‰
$word = str_replace("&lsaquo;","\\u8249\'3f",$word); // ‹
$word = str_replace("&rsaquo;","\\u8250\'3f",$word); // ›
$word = str_replace("&euro;","\\u8364\'3f",$word); // €


$word = str_replace("&","\\u38\'3f",$word);
$word = str_replace("¡","\\u161\'3f",$word);
$word = str_replace("¢","\\u162\'3f",$word);
$word = str_replace("£","\\u163\'3f",$word);
$word = str_replace("¤","\\u164\'3f",$word);
$word = str_replace("¥","\\u165\'3f",$word);
$word = str_replace("¦","\\u166\'3f",$word);
$word = str_replace("§","\\u167\'3f",$word);
$word = str_replace("¨","\\u168\'3f",$word);
$word = str_replace("©","\\u169\'3f",$word);
$word = str_replace("ª","\\u170\'3f",$word);
$word = str_replace("«","\\u171\'3f",$word);
$word = str_replace("¬","\\u172\'3f",$word);
$word = str_replace("®","\\u174\'3f",$word);
$word = str_replace("¯","\\u175\'3f",$word);
$word = str_replace("°","\\u176\'3f",$word);
$word = str_replace("±","\\u177\'3f",$word);
$word = str_replace("²","\\u178\'3f",$word);
$word = str_replace("³","\\u179\'3f",$word);
$word = str_replace("´","\\u180\'3f",$word);
$word = str_replace("µ","\\u181\'3f",$word);
$word = str_replace("¶","\\u182\'3f",$word);
$word = str_replace("·","\\u183\'3f",$word);
$word = str_replace("¸","\\u184\'3f",$word);
$word = str_replace("¹","\\u185\'3f",$word);
$word = str_replace("º","\\u186\'3f",$word);
$word = str_replace("»","\\u187\'3f",$word);
$word = str_replace("¼","\\u188\'3f",$word);
$word = str_replace("½","\\u189\'3f",$word);
$word = str_replace("¾","\\u190\'3f",$word);
$word = str_replace("¿","\\u191\'3f",$word);
$word = str_replace("À","\\u192\'3f",$word);
$word = str_replace("Á","\\u193\'3f",$word);
$word = str_replace("Â","\\u194\'3f",$word);
$word = str_replace("Ã","\\u195\'3f",$word);
$word = str_replace("Ä","\\u196\'3f",$word);
$word = str_replace("Å","\\u197\'3f",$word);
$word = str_replace("Æ","\\u198\'3f",$word);
$word = str_replace("Ç","\\u199\'3f",$word);
$word = str_replace("È","\\u200\'3f",$word);
$word = str_replace("É","\\u201\'3f",$word);
$word = str_replace("Ê","\\u202\'3f",$word);
$word = str_replace("Ë","\\u203\'3f",$word);
$word = str_replace("Ì","\\u204\'3f",$word);
$word = str_replace("Í","\\u205\'3f",$word);
$word = str_replace("Î","\\u206\'3f",$word);
$word = str_replace("Ï","\\u207\'3f",$word);
$word = str_replace("Ð","\\u208\'3f",$word);
$word = str_replace("Ñ","\\u209\'3f",$word);
$word = str_replace("Ò","\\u210\'3f",$word);
$word = str_replace("Ó","\\u211\'3f",$word);
$word = str_replace("Ô","\\u212\'3f",$word);
$word = str_replace("Õ","\\u213\'3f",$word);
$word = str_replace("Ö","\\u214\'3f",$word);
$word = str_replace("×","\\u215\'3f",$word);
$word = str_replace("Ø","\\u216\'3f",$word);
$word = str_replace("Ù","\\u217\'3f",$word);
$word = str_replace("Ú","\\u218\'3f",$word);
$word = str_replace("Û","\\u219\'3f",$word);
$word = str_replace("Ü","\\u220\'3f",$word);
$word = str_replace("Ý","\\u221\'3f",$word);
$word = str_replace("Þ","\\u222\'3f",$word);
$word = str_replace("ß","\\u223\'3f",$word);
$word = str_replace("à","\\u224\'3f",$word);
$word = str_replace("á","\\u225\'3f",$word);
$word = str_replace("â","\\u226\'3f",$word);
$word = str_replace("ã","\\u227\'3f",$word);
$word = str_replace("ä","\\u228\'3f",$word);
$word = str_replace("å","\\u229\'3f",$word);
$word = str_replace("æ","\\u230\'3f",$word);
$word = str_replace("ç","\\u231\'3f",$word);
$word = str_replace("è","\\u232\'3f",$word);
$word = str_replace("é","\\u233\'3f",$word);
$word = str_replace("ê","\\u234\'3f",$word);
$word = str_replace("ë","\\u235\'3f",$word);
$word = str_replace("ì","\\u236\'3f",$word);
$word = str_replace("í","\\u237\'3f",$word);
$word = str_replace("î","\\u238\'3f",$word);
$word = str_replace("ï","\\u239\'3f",$word);
$word = str_replace("ð","\\u240\'3f",$word);
$word = str_replace("ñ","\\u241\'3f",$word);
$word = str_replace("ò","\\u242\'3f",$word);
$word = str_replace("ó","\\u243\'3f",$word);
$word = str_replace("ô","\\u244\'3f",$word);
$word = str_replace("õ","\\u245\'3f",$word);
$word = str_replace("ö","\\u246\'3f",$word);
$word = str_replace("÷","\\u247\'3f",$word);
$word = str_replace("ø","\\u248\'3f",$word);
$word = str_replace("ù","\\u249\'3f",$word);
$word = str_replace("ú","\\u250\'3f",$word);
$word = str_replace("û","\\u251\'3f",$word);
$word = str_replace("ü","\\u252\'3f",$word);
$word = str_replace("ý","\\u253\'3f",$word);
$word = str_replace("þ","\\u254\'3f",$word);
$word = str_replace("ÿ","\\u255\'3f",$word);
$word = str_replace("Œ","\\u338\'3f",$word);
$word = str_replace("œ","\\u339\'3f",$word);
$word = str_replace("Š","\\u352\'3f",$word);
$word = str_replace("š","\\u353\'3f",$word);
$word = str_replace("Ÿ","\\u376\'3f",$word);
$word = str_replace("ˆ","\\u710\'3f",$word);
$word = str_replace("˜","\\u732\'3f",$word);
$word = str_replace("–","\\u8211\'3f",$word);
$word = str_replace("—","\\u8212\'3f",$word);
$word = str_replace("‘","\\u8216\'3f",$word);
$word = str_replace("’","\\u8217\'3f",$word);
$word = str_replace("‚","\\u8218\'3f",$word);
$word = str_replace("“","\\u8220\'3f",$word);
$word = str_replace("”","\\u8221\'3f",$word);
$word = str_replace("„","\\u8222\'3f",$word);
$word = str_replace("†","\\u8224\'3f",$word);
$word = str_replace("‡","\\u8225\'3f",$word);
$word = str_replace("‰","\\u8240\'3f",$word);
$word = str_replace("‹","\\u8249\'3f",$word);
$word = str_replace("›","\\u8250\'3f",$word);
$word = str_replace("€","\\u8364\'3f",$word);



$word = preg_replace("/<br(.*?)\/>/i", "\\par\\par ", $word);
$word = preg_replace("/<p(.*?)>/i", "", $word);
$word = preg_replace("/<\/p>/i", "\\par \\par", $word);

$word = preg_replace("/<strong(.*?)>/", "{\\b ", $word);
$word = preg_replace("/<\/strong>/", "}", $word);
$word = preg_replace("/<h1(.*?)>/", "{\\b ", $word);
$word = preg_replace("/<\/h1>/", "}", $word);
$word = preg_replace("/<h2(.*?)>/", "{\\b ", $word);
$word = preg_replace("/<\/h2>/", "}", $word);
$word = preg_replace("/<h3(.*?)>/", "{\\b ", $word);
$word = preg_replace("/<\/h3>/", "}", $word);
$word = preg_replace("/<b>/", "{\\b ", $word);
$word = preg_replace("/<\/b>/", "}", $word);

$word = preg_replace("/<em(.*?)>/", "{\\i ", $word);
$word = preg_replace("/<\/em>/", "}", $word);
$word = preg_replace("/<i>/", "{\\i ", $word);
$word = preg_replace("/<\/i>/", "}", $word);

$word = preg_replace("/<ul(.*?)>/", "\\par", $word);
$word = preg_replace("/<\/ul>/", "", $word);
$word = preg_replace("/<li(.*?)>/", "", $word);
$word = preg_replace("/<\/li>/", "\\par\\par", $word);

$word = preg_replace("/<u(.*?)>/", "{\\ul ", $word);
$word = preg_replace("/<\/u>/", "}", $word);

$word = preg_replace("/<a(.*?)>/", "", $word);
$word = preg_replace("/<\/a>/", "", $word);

$word = preg_replace("/<colgroup(.*?)>/", "", $word);
$word = preg_replace("/<\/colgroup>/", "", $word);
$word = preg_replace("/<col (.*?)>/", "", $word);
$word = preg_replace("/<\/col>/", "", $word);
$word = preg_replace("/<font(.*?)>/", "", $word);
$word = preg_replace("/<\/font>/", "", $word);
$word = preg_replace("/<style(.*?)>/", "", $word);
$word = preg_replace("/<\/style>/", "", $word);
$word = preg_replace("/<tbody(.*?)>/", "", $word);
$word = preg_replace("/<\/tbody>/", "", $word);
$word = preg_replace("/<span(.*?)>/", "", $word);
$word = preg_replace("/<\/span>/", "", $word);
$word = preg_replace("/<div(.*?)>/", "", $word);
$word = preg_replace("/<\/div>/", "", $word);

$word = preg_replace("/<!--(.*?)>/", "", $word);
$word = preg_replace("/<\/-->/", "", $word);

$word = preg_replace("/<img(.*?)>/", "", $word);

$word = preg_replace("/<tbody(.*?)>/", "", $word);
$word = preg_replace("/<\/tbody>/", "", $word);

//CREACION DE TABLA RTF
if (substr_count($word, '<table') > 0) {
    $count_tr = substr_count($word, '<tr');
    $count_td = substr_count($word, '<td');
    $count_td = $count_td / $count_tr;

    $width = '1000';
    $columns = "";
    for ($i = 0; $i < $count_td; $i++) {
        $columns.= '\\clbrdrl\\brdrw10\\brdrs \\clbrdrt\\brdrw10\\brdrs \\clbrdrr\\brdrw10\\brdrs \\clbrdrb\\brdrw10\\brdrs \\cellx' . $width . ' ';
        $width+= '2000';
    };
    $word = preg_replace("/<table(.*?)>/", "{ " . $columns, $word);

    $word = preg_replace("/<tr(.*?)>/", "", $word);
    $word = preg_replace("/<\/tr>/", "\\ROW", $word);
    $word = preg_replace("/<td(.*?)>/", "", $word);
    $word = preg_replace("/<\/td>/", "\\cell", $word);
    $word = preg_replace("/<\/table>/", "}", $word);    
}

$word = str_replace('"',"\\u34\'3f",$word);
$word = str_replace("<","\\u60\'3f",$word);
$word = str_replace(">","\\u62\'3f",$word);

//        $word = str_replace("	","\t",$word);

        return $word;
    }
    
    
    public function generarUsuario($primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido){
        $primer_nombre = strtolower($primer_nombre);
        $primer_nombre = str_replace(" ", "",$primer_nombre);
        $primer_nombre = str_replace("á", "a",$primer_nombre);
        $primer_nombre = str_replace("é", "e",$primer_nombre);
        $primer_nombre = str_replace("í", "i",$primer_nombre);
        $primer_nombre = str_replace("ó", "o",$primer_nombre);
        $primer_nombre = str_replace("ú", "u",$primer_nombre);

        $segundo_nombre = strtolower($segundo_nombre);
        $segundo_nombre = str_replace(" ", "",$segundo_nombre);
        $segundo_nombre = str_replace("á", "a",$segundo_nombre);
        $segundo_nombre = str_replace("é", "e",$segundo_nombre);
        $segundo_nombre = str_replace("í", "i",$segundo_nombre);
        $segundo_nombre = str_replace("ó", "o",$segundo_nombre);
        $segundo_nombre = str_replace("ú", "u",$segundo_nombre);

        $primer_apellido = strtolower($primer_apellido);
        $primer_apellido = str_replace(" ", "",$primer_apellido);
        $primer_apellido = str_replace("á", "a",$primer_apellido);
        $primer_apellido = str_replace("é", "e",$primer_apellido);
        $primer_apellido = str_replace("í", "i",$primer_apellido);
        $primer_apellido = str_replace("ó", "o",$primer_apellido);
        $primer_apellido = str_replace("ú", "u",$primer_apellido);

        $segundo_apellido = strtolower($segundo_apellido);
        $segundo_apellido = str_replace(" ", "",$segundo_apellido);
        $segundo_apellido = str_replace("á", "a",$segundo_apellido);
        $segundo_apellido = str_replace("é", "e",$segundo_apellido);
        $segundo_apellido = str_replace("í", "i",$segundo_apellido);
        $segundo_apellido = str_replace("ó", "o",$segundo_apellido);
        $segundo_apellido = str_replace("ú", "u",$segundo_apellido);


        // '1er nombre' . '1er apellido'
        $cadena_usuario = $primer_nombre.'.'.$primer_apellido;
        $funcionario_usuario = Doctrine::getTable('Acceso_Usuario')->findOneBy('nombre',strtolower($cadena_usuario));
        if($funcionario_usuario['id']) {
                // '1er nombre' '2do nombre inicial' . '1er apellido'
                $cadena_usuario = $primer_nombre.substr($segundo_nombre,0,1).'.'.$primer_apellido;
                $funcionario_usuario = Doctrine::getTable('Acceso_Usuario')->findOneBy('nombre',strtolower($cadena_usuario));
                if($funcionario_usuario['id']) {
                        // '1er nombre' . '1er apellido' '2do apellido inicial'
                        $cadena_usuario = $primer_nombre.'.'.$primer_apellido.substr($segundo_apellido,0,1);
                        $funcionario_usuario = Doctrine::getTable('Acceso_Usuario')->findOneBy('nombre',strtolower($cadena_usuario));
                        if($funcionario_usuario['id']) {
                                // '1er nombre' '2do nombre inicial' . '1er apellido' '2do apellido inicial'
                                $cadena_usuario = $primer_nombre.substr($segundo_nombre,0,1).'.'.$primer_apellido.substr($segundo_apellido,0,1);
                                $funcionario_usuario = Doctrine::getTable('Acceso_Usuario')->findOneBy('nombre',strtolower($cadena_usuario));

                                $char=97; $x=1;
                                while($funcionario_usuario['id'] && ($char<123)) {
                                        if($x==1) { $a=chr($char); $b=''; $x=2; }
                                        else { $b=chr($char); $a=''; $char++; $x=1; }

                                        $cadena_usuario = $primer_nombre.substr($segundo_nombre,0,1).$a.'.'.$primer_apellido.substr($segundo_apellido,0,1).$b;
                                        $funcionario_usuario = Doctrine::getTable('Acceso_Usuario')->findOneBy('nombre',strtolower($cadena_usuario));
                                }
                        }
                }
        }
    
        return $cadena_usuario;
    }
    
    function tiempo_transcurrido($fecha, $pre= NULL) {
	if(empty($fecha)) {
		  return "No hay fecha";
	}
   
	$intervalos = array("segundo", "minuto", "hora", "día", "semana", "mes", "año");
	$duraciones = array("60","60","24","7","4.35","12");
   
	$ahora = time();
	$Fecha_Unix = strtotime($fecha);
	
	if(empty($Fecha_Unix)) {   
		  return "Fecha incorracta";
	}
	if($ahora > $Fecha_Unix) {   
		  $diferencia     =$ahora - $Fecha_Unix;
		  $tiempo         = "Hace";
	} else {
		  $diferencia     = $Fecha_Unix -$ahora;
		  $tiempo         = "Dentro de";
	}
	for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
	  $diferencia /= $duraciones[$j];
	}
	$diferencia = round($diferencia);
        
	if($diferencia != 1) {
		$intervalos[5].="e"; //MESES
		$intervalos[$j].= "s";
	}
        
        if($j== 5) {
            if($diferencia > 12) {
                $diferencia/= 12;
                $diferencia = round($diferencia);
                $j= 6;
                if($diferencia != 1)
                    $intervalos[$j].="s"; //AÑOS
            }
        }
        
        if($pre)
            return "$diferencia $intervalos[$j]";
        else
            return "$tiempo $diferencia $intervalos[$j]";
    }
}
?>