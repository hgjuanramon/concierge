<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * Datos a pasar a la vista
     * @_data array
     */
    protected $_data;

    /**
     * Elementos del menu
     * @_nav array
     */
    protected $_nav;

    /**
     * Elemento del menu que estara activo 
     * @_nav_active string
     */
    protected $_nav_active;

    /**
     * Elementos del menu tipo "Migas de pan"
     * @_breadcrumb array
     */
    protected $_breadcrumb = array();

    /**
     * Carpeta/Ruta a la carpeta de subidas
     * @_upload_path string
     */
    protected $_upload_path;

    /**
     * Configuracion para la subida de archivos
     * @var $_upload_settings array
     */
    protected $_upload_settings;

    /**
     * Configuracion de las miniaturas
     * @var $_thumbs array
     */
    protected $_thumbs;

    /**
     * Modelo por default/principal para el controlador
     * @_model Object
     */
    protected $_model;

    /**
     * Carpeta/Ruta donde se encuentran los controladores
     * @_cfolder string
     */
    protected $_cfolder = '';

    /**
     * Carpeta/Ruta donde se encuentran las vistas
     * @_vfolder string
     */
    protected $_vfolder = 'frontend/';

    /**
     * Nombre del modulo actual
     * @_module_name
     */
    protected $_module_name;

    /**
     * Nombre del controlador actual
     * @_controller_name string
     */
    protected $_controller_name;

    /**
     * Accion del controlador
     * @_action_name
     */
    protected $_action_name;

    /**
     * Nombre del metodo actual
     * @_method_name string
     */
    protected $_method_name;

    public function __construct() {
        parent::__construct();
        $this->_module_name = strtolower($this->router->fetch_module());
        $this->_controller_name = strtolower($this->router->fetch_class());
        $this->_action_name = strtolower($this->router->fetch_method());
        $this->_set_active_nav($this->_controller_name);
        //$this->_method_name = strtolower($this->router->fetch_method());
    }

    /**
     * Configura el item del menu que estara activo
     * @param string $active Item del menu 
     */
    protected function _set_active_nav($active) {
        $this->_nav_active = $active;
        return $this;
    }

    /**
     * Carga la plantilla por defecto junto con el javascript correspondiente
     * @param array $js_args argumentos a pasar a javascript
     */
    protected function _render($js_args = array()) {
        $this->template->add_js('js/main.js');
        $this->_render_js($js_args);
        $this->_render_nav();
        $this->template->build($this->_action_name, $this->_data);
    }

    /**
     * Elimina archivos
     * @param mixed $filename
     * @example $this->_delete_file(array('file' => 'public_html/.../logo.jpg', 'thumbs' => array('60x60_', '200x110_')));
     */
    protected function _delete_file($file) {
        if (is_array($file)) {

            // Obtener el nombre del archivo
            $file_name = basename($file['file']);

            // Obtener el path del archivo
            $path = rtrim(dirname($file['file']), '/') . '/';

            // Eliminar el archivo original
            @unlink($file['file']);

            // Eliminar las miniaturas
            foreach ($file['thumbs'] as $thumb) {
                @unlink($path . $thumb . $file_name);
            }
        } else {
            @unlink($file);
        }
    }

    /**
     * Genera el menu principal
     * @return Object Instancia
     */
    protected function _render_nav() {
        $this->menu->reset();
        $this->template->nav($this->menu->render($this->_nav, $this->_nav_active), TRUE);
        return $this;
    }

    /**
     * Genera un menu de tipo breadcrumb
     * @return Object Instancia
     */
    protected function _render_breadcrumb() {

        $this->menu->reset();
        $this->menu->initialize(array('container_tag_class' => 'breadcrumb', 'home_link' => ''));

        $breadcrumb = array();
        $c = 0;
        $active = null;

        // Revertir el array manteniendo las keys
        $breadcrumb_rev = array_reverse($this->_breadcrumb, true);

        foreach ($breadcrumb_rev as $key => $value) {

            // Obtener el primer item y marcarlo como el activo
            if ($c == 0) {
                $active = $value['location'];
            }

            // Obtener el parent id (location del item padre) 
            $parent_key = ($key - 1);
            if (array_key_exists($parent_key, $breadcrumb_rev)) {
                $parent_location = $breadcrumb_rev[$parent_key]['location'];
                $value['parent_id'] = $parent_location;
            }

            // Formar el array como lo pide la libreria key(location) => value(array valores)
            $breadcrumb[$value['location']] = $value;

            $c++;
            continue;
        }

        $this->template->breadcrumb = $this->menu->render($breadcrumb, $active, NULL, 'breadcrumb');
        return $this;
    }

    /**
     * Genera el Javascript para la plantilla
     * @param  array  $js_args Argumentos Javascript extra
     * @return void
     */
    protected function _render_js($js_args = array()) {
        $this->template->add_js('APP.init(' . json_encode(array_merge($this->_get_js_default(), $js_args)) . ').run();', 'embed');
    }

    /**
     * Retorna los argumentos Javascript por default
     * @return array Argumentos Javascript
     */
    protected function _get_js_default() {
        return array(
            'module' => $this->_module_name,
            'controller' => $this->_controller_name,
            'action' => $this->_action_name,
            'base_url' => base_url()
        );
    }

    /**
     * Retorna los argumentos de busqueda/filtro pasados por GET
     * @return array
     */
    protected function _get_search_params() {
        // Obtiene todos los parametros pasados por GET
        $params = $this->input->get();

        if (empty($params) || $params === false) {
            return '';
        }

        // Quitar el argumento per_page por que esto afecta la paginacion
        unset($params['per_page']);

        // Construir los argumentos en formato URL
        return http_build_query($params, '', '&');
    }

    protected function _upload_file($field, $id = null) {

        $config = array();
        $response = array();

        if (!isset($this->_upload_settings['upload_path'])) {
            $this->_upload_settings['upload_path'] = $this->_upload_path;
        }

        switch ($field) {
            case 'documento':
                $config['upload_path'] = $this->_upload_path;
                $config['allowed_types'] = '*';
                $config['max_filename'] = 20;
                $config['encrypt_name'] = TRUE;
                break;
            default:
                $config['upload_path'] = $this->_upload_path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_filename'] = 20;
                $config['encrypt_name'] = TRUE;
                break;
        }

        // Mix settings
        $config = array_merge($config, $this->_upload_settings);

        $this->upload->initialize($config);

        if ($this->upload->do_upload($field)) {

            $response = $this->upload->data();

            // Delete current files
            if (!empty($id)) {
                $record = $this->_model->get_by_id($id);
                if (!empty($record->$field)) {
                    $this->_remove_file($record->$field);
                }
            }

            if ($response['is_image']) {
                $this->load->library('imagekit');
                $this->imagekit->initialize($response['full_path']);

                // Generate thumbs
                foreach ($this->_thumbs as $thumb) {
                    $method = $thumb['type'];
                    if ($method === 'crop') {
                        $this->imagekit->$method($thumb['width'], $thumb['height']);
                    } else {
                        if ($method === 'resize' && isset($thumb['ratio'])) {
                            $this->imagekit->$method($thumb['width'], $thumb['height'], TRUE);
                        } else {
                            $this->imagekit->$method($thumb);
                        }
                    }
                }
            }
        } else {

            $response['error'] = $this->upload->display_errors();
        }

        return $response;
    }

    protected function _multiple_upload_file($field, $id = null) {

        $config = array();
        $response = array();

        if (!isset($this->_upload_settings['upload_path'])) {
            $this->_upload_settings['upload_path'] = $this->_upload_path;
        }

        switch ($field) {
            default:
                $config['upload_path'] = $this->_upload_path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_filename'] = 20;
                $config['encrypt_name'] = TRUE;
                break;
        }

        // Mix settings
        $config = array_merge($config, $this->_upload_settings);
        $this->upload->initialize($config);
        if ($this->upload->do_multi_upload($field)) {

            $response = $this->upload->get_multi_upload_data();

            foreach ($response as $value) {
                if ($value['is_image']) {
                    $this->load->library('imagekit');
                    $this->imagekit->initialize($value['full_path']);
                    // Generate thumbs
                    foreach ($this->_thumbs as $thumb) {
                        $method = $thumb['type'];
                        if ($method === 'crop') {
                            $this->imagekit->$method($thumb['width'], $thumb['height']);
                        } else {
                            if ($method === 'resize' && isset($thumb['ratio'])) {
                                $this->imagekit->$method($thumb['width'], $thumb['height'], TRUE);
                            } else {
                                $this->imagekit->$method($thumb);
                            }
                        }
                    }
                }
            }
        } else {

            $response['error'] = $this->upload->display_errors();
        }
        return $response;
    }

    /**
     * Remove file from the server and if is an image delete his thumbnails
     * @param  $filename File name
     * @return void
     */
    protected function _remove_file($filename) {

        if (empty($this->_upload_path)) {
            exit('Invalid path');
        }

        if (!empty($this->_thumbs)) {
            // Remove image and thumbs
            $thumbs = array();
            foreach ($this->_thumbs as $thumb) {
                array_push($thumbs, $thumb['width'] . 'x' . $thumb['height'] . '_');
            }
            $this->_delete_file(array('file' => $this->_upload_path . $filename, 'thumbs' => $thumbs));
        } else {
            // Remove single file
            $this->_delete_file($this->_upload_path . $filename);
        }
    }

}
