<?php

class numerosLetras {
    /**
    * Arreglo de palabras representando a las letras
    * [0] Cero y Uno
    * [1] Unidades(1-9) donde 1=>Un, números (10-29) y 100
    * [2] Decenas del (30-90)
    * [3] Centenas(100-900) donde 100 => Ciento
    * [4] Notación larga Cifras cerradas
    * [5] Notación larga para los sufijos..
    * El arreglo 4 y 5 se puede incrementar para soportar numeros superiores
    * @var array
    */
    private static $nStr = array(array('cero', 'uno'),
            array('', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete',
                    'ocho', 'nueve', 'diez', 'once', 'doce', 'trece',
                    'catorce', 'quince', 'dieciséis', 'diecisite', 'dieciocho',
                    'diecinueve', 'veinte', 'veintiuno', 'veintidós',
                    'veintitrés', 'veinticuatro', 'veinticinco', 'veintiséis',
                    'veintisiete', 'veintiocho', 'veintinueve', 100 => 'cien'),
            array('', '', '', 'treinta', 'cuarenta', 'cincuenta', 'sesenta',
                    'setenta', 'ochenta', 'noventa'),
            array('', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
                    'quinientos', 'seicientos', 'setecientos', 'ochocientos',
                    'novecientos'),
            array('', '', 'mil', 'millón', 'mil', 'billón', 'mil', 'trillón',
                    'mil', 'cuatrillón', 'mil', 'quintillón', 'mil',
                    'sextillón', 'mil', 'septillón', 'mil', 'octillón'),
            array('', '', 'mil', 'millones', 'mil', 'billones', 'mil',
                    'trillones', 'mil', 'cuatrillones', 'mil', 'quintillones',
                    'mil', 'sextillones', 'mil', 'septillones', 'mil',
                    'octillones', 'mil'));
    /**
    * Obtiene un nombre que respresenta al número en letras
    * @param integer $n Número del 0 al 29, 100 y 1000
    * @param integer $c 1=Unidad, 2=Decena y 3=Centena 4,5 Millar y *illones
    * @param integer $l Numero de nivel de agrupaciones de  3 ceros
    * @return string
    */
    private static function _num($n, $c = 1, $l = 1) {
        return ($n == 1 && !($l % 2)) || !$l ? '' : self::$nStr[$c][$n] . ' ';
    }
    /**
    * Convierte recursivamente un numero a letras
    * @param integer $lev Numero de cifras agrupadas en 3: Ej. 100101 = 2
    * @param srting $number Número a convetir a letras
    * @return string
    */
    private static function _i2str($lev, $number) {
        $int = intval($num = substr($number, 0, 3));
        $next = substr($number, 3);
        $str = ''; //echo "($lev|$num|$int|$number)<hr>\n"; //Debug
        if ($int) {
            if ($int == 100)
                $str = self::_num($int, 1);
            else {
                list($c, $d, $u) = $num;//centenas, decenas y unidad
                $str = $c ? self::_num($c, 3) : '';
                if (($du = (($d * 10) + $u)) < 30)
                    $str .= self::_num($du, $du == 1 && $lev < 2 ? 0 : 1, $lev);
                else {
                    $str .= $d ? self::_num($d, 2) . ($u ? 'y ' : '') : '';
                    $str .= $u ? self::_num($u, $u + $lev < 3 ? 0 : 1) : '';
                }
            }
            $str .= self::_num($lev, $int == 1 && ($lev % 2) ? 4 : 5)
                    . (preg_match('/^000+/', $next) ? self::_num($lev - 1, 5,
                                    !($lev % 2)) : '');
        }
        return $lev ? ($str . self::_i2str($lev - 1, $next)) : '';
    }
    /**
    * Convierte una cadena numerica o numero a letras
    * @param string $number
    * @return boolean|string
    */
    public static function toWord($number,$sufijo_entero='',$sufijo_decimal='') {
        $less = preg_match('/^\-/', $number);
        $number = preg_replace('/[^0-9\.]/', '', $number);
        if (preg_match('/^(\d{1,54})$/', $number)) {
            $lev = (floor(strlen($number) / 3) + 1);
            $number = str_pad($number, ($lev * 3), '0', STR_PAD_LEFT);
            $result = self::_i2str($lev, $number);
            $result || ($result = self::_num(0, 0));
        } elseif (preg_match('/^\d{1,54}\.\d{1,54}$/', $number)) {
            list($number, $decimal) = explode('.', $number);
            $result = self::toWord($number) . ' ' .$sufijo_entero.' con ';
            for ($i = 0; $i < (strlen($decimal) - 1); $i++) {
                if ($decimal[$i])
                    break;
                $result .= self::_num(0, 0);
            }
            $result .= self::toWord($decimal).' '.$sufijo_decimal;
        }
        
        $result = trim(str_replace('  ', ' ', $result));
        
        return isset($result) ? ($less ? 'menos ' : '') . $result : FALSE;
    }
}
