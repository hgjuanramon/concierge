<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "home";
$route['404_override'] = '';

// Backend Routes
$this->config->load('backend', TRUE);
$backend_config = $this->config->item('backend');
$auth_module = $backend_config['auth_module'];
$backend_controller = $backend_config['backend_controller'];

$route[$auth_module . '/([a-zA-Z_-]+)/(:any)'] = '$1/' . $backend_controller . '/$2';
$route[$auth_module . '/([a-zA-Z_-]+)'] = '$1/' . $backend_controller . '/index';
$route[$auth_module . '/login'] = $auth_module . '/login';
$route[$auth_module . '/logout'] = $auth_module . '/logout';
$route[$auth_module . '/enable_admin'] = $auth_module . '/enable_admin';
$route[$auth_module] = $auth_module;
/* End of file routes.php */
/* Location: ./application/config/routes.php */