<?php

/**
 * Obtiene la uri actual
 *
 * @param  bool $method Indica si retornara el metodo actual
 * @return mixed retorna la uri actual controllers_folder + controller_name (+method_name)
 * @access public
 */
if (!function_exists('get_current_route')) {
    function get_current_route($method = false) {
        $CI = & get_instance();
        return $CI->router->fetch_module() .'/'. (($method) ? $CI->router->fetch_method() . '/' : '');
    }
}

/**
 * Obtiene el modulo actual +  la URI pasada
 * @param string $uri Uri a concatenar en la respuesta
 * @return string uri actual
 * @access public
 */
if (!function_exists('get_current_module')) {
    function get_current_module($uri = null) {
        $CI = & get_instance();
        return $CI->router->fetch_module() . $uri;
    }
}

/**
 * url_title mejorado para que remplace acentos y carateres especiales
 * a su correspondiente caracter 
 */
if (!function_exists('enhanced_url_title')) {
    function enhanced_url_title($str, $separator = 'dash', $lowercase = FALSE) {
        $separator = ($separator == 'dash') ? '-' : '_';
        $from = array(' ', 'ă', 'á', 'à', 'â', 'ã', 'ª', 'Á', 'À','Â', 'Ã', 'é', 'è', 'ê', 'É', 'È', 'Ê', 'í', 'ì', 'î', 'Í',
            'Ì', 'Î', 'ò', 'ó', 'ô', 'õ', 'º', 'Ó', 'Ò', 'Ô', 'Õ', 'ş', 'Ş', 'ţ', 'Ţ', 'ü', 'ú', 'ù', 'û', 'Ü', 'Ú', 'Ù', 'Û', 'ç', 'Ç', 'Ñ', 'ñ');
        $to = array($separator, 'a', 'a', 'a', 'a', 'a', 'a', 'A', 'A','A', 'A', 'e', 'e', 'e', 'E', 'E', 'E', 'i', 'i', 'i', 'I', 'I',
            'I', 'o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 's', 'S','t', 'T', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'c', 'C', 'N', 'n');
        $str = trim(str_replace($from, $to, strip_tags($str)));
        if ($lowercase === TRUE)
            $str = (function_exists ('mb_strtolower')) ? mb_strtolower($str) : strtolower($str);
        return $str;
    }
}