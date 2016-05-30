<?php

/**
 * Limpia el valor de una variable de tipo POST O GET
 *
 * @param string $name nombre del campo a limpiar
 * @param bool $strip_tags indica si removeremos los tags html
 * @param bool $xss indica si removeremos los tags como script img o algun otro que sea considerado dañino
 * @param string $type post, get
 * @return mixed retorna el valor del campo limpio 
 * @access	public
 */
if (!function_exists('clear_input')) {

    function clear_input($name, $strip_tags = TRUE, $xss = TRUE, $type = 'post') {
        $CI = & get_instance();

        if ($strip_tags) {
            return strip_tags(trim($CI->input->$type($name, TRUE)));
        } else {
            if ($xss) {
                return trim($CI->input->$type($name, TRUE));
            } else {
                return trim($CI->input->$type($name));
            }
        }
    }

}

/**
 * Imprime un array con formato legible
 * @param  array $array
 * @return void
 * @access	public
 */
if (!function_exists('print_ar')) {

    function print_ar($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}

/**
 * Obtiene un string aleatorio
 * $password_type opciones:
 * standard => solo letras
 * numeric => solo numeros
 * alphanum => numeros y letras
 * any => todos los caracteres
 * @param int $length número de caracteres maximos que regresara
 * @param string $type (solo letras, solo numeros, alfanumerico, cualquier caracter)
 * @return string la cadena generada
 */
if (!function_exists('get_random_string')) {

    function get_random_string($length = 8, $type = 'standard') {
        $ranges = '';
        switch ($type) {
            case 'standard':
                $ranges = '65-78,80-90,97-107,109-122';
                break;
            case 'numeric':
                $ranges = '48-57';
                break;
            case "alphanum":
                $ranges = '65-90,97-122,48-57';
                break;
            case "any":
                $ranges = '40-59,61-91,93-126';
                break;
        }
        if (!empty($ranges)) {
            $range = explode(',', $ranges);
            $num_ranges = count($range);
            mt_srand(time()); //not required after PHP v4.2.0
            $p = '';
            for ($i = 1; $i <= $length; $i++) {
                $r = mt_rand(0, $num_ranges - 1);
                list($min, $max) = explode('-', $range[$r]);
                $p.=chr(mt_rand($min, $max));
            }
            return $p;
        }
    }

}

/**
 * Obtiene la ip real del usuario
 */
if (!function_exists('get_real_ip')) {

    function get_real_ip() {

        if (isset ($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty ($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            
            $client_ip = (!empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( (!empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );

            // los proxys van añadiendo al final de esta cabecera
            // las direcciones ip que van "ocultando". Para localizar la ip real
            // del usuario se comienza a mirar por el principio hasta encontrar
            // una dirección ip que no sea del rango privado. En caso de no
            // encontrarse ninguna se toma como valor el REMOTE_ADDR

            $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

            reset($entries);
            while (list(, $entry) = each($entries)) {
                $entry = trim($entry);
                if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
                    // http://www.faqs.org/rfcs/rfc1918.html
                    $private_ip = array(
                        '/^0\./',
                        '/^127\.0\.0\.1/',
                        '/^192\.168\..*/',
                        '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                        '/^10\..*/');

                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                    if ($client_ip != $found_ip) {
                        $client_ip = $found_ip;
                        break;
                    }
                }
            }
            
        } else {
            $client_ip = (!empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( (!empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );
        }
        return $client_ip;
    }

}

/**
 * Obtiene la extencion de un archivo
 */
if(!function_exists('get_extension')){
    /**
    * Obtiene la extencion de un archivo
    * @param $filename nombre del archivo
    * @return string extencion
    */
    function get_extension($filename){
        return strtolower(end(explode(".", $filename)));
    }
}

/**
 * Genera un identificador unico
 */
if(!function_exists('gen_uuid')){
    function gen_uuid($len=8) {
        $hex = md5("dhamasito" . uniqid("", true));
        $pack = pack('H*', $hex);
        $tmp =  base64_encode($pack);
        //$uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp); Minusculas y Mayusculas
        $uid = preg_replace("#(*UTF8)[^A-Z0-9]#", "", $tmp);
        $len = max(4, min(128, $len));
        while (strlen($uid) < $len){
            $uid .= gen_uuid(22);
        }
        return substr($uid, 0, $len);
    }
}

/**
 * Muestra mensajes de tipo alert en la pantalla
 */
if(!function_exists('show_alert')){
    function show_alert($msg, $type=null){
        $html = '<div class="alert '. ((!empty($type) ? ' alert-' . $type : '')) .'">';
        $html.= '<button type="button" class="close" data-dismiss="alert">×</button>';
        $html.= $msg;
        $html.= '</div>';
        return $html;
    }
}