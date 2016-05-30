<?php

if (!function_exists('backend_slug')) {
    function backend_slug($uri = null) {
        $CI = & get_instance();
        $CI->config->load('backend', TRUE);
        $backend_config = $CI->config->item('backend');
        $backend_slug = $backend_config['backend_slug'];
        return $backend_slug . $uri;
    }
}

/**
 * Retorna el modulo actual con el prefijo del backend
 */
if (!function_exists('backend_module')) {
    function backend_module($uri = null, $slash = true) {
        $CI = & get_instance();
        $current_module = rtrim($CI->router->fetch_module() .'/'. ltrim($uri, '/'), '/');
        return backend_slug($current_module);
    }
}

if (!function_exists('backend_current_route')) {
    function backend_current_route($method = false) {
        $CI = & get_instance();
        return backend_module() .'/'. (($method) ? $CI->router->fetch_method() . '/' : '');
    }
}