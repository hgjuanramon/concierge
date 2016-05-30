<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Back_Controller extends MY_Controller {

    protected $_user;
    protected $_backend_config;

    public function __construct() {
        parent::__construct();
        $this->_backend_config = $this->config->item('backend');
        $auth_module = $this->_backend_config['auth_module'];

        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in()) {
            redirect('admin/login');
        }
        $this->_user = $this->flexi_auth->get_user_by_id($this->flexi_auth->get_user_id())->row();
    }

    /**
     * Initialize common settings
     */
    protected function _init() {
        $this->_check_permissions();
        $this->template->set_layout('backend');
        $this->load->library('menu');
        $this->load->library('form_validation');
        $this->load->library('message');
        $this->load->helper('toolkit');
        $this->template->user_data = $this->_user;
        $this->_init_nav();
        $this->template->add_css('assets/css/normalize.css');
        $this->template->add_css('assets/css/bootstrap.min.css');
        $this->template->add_css('assets/css/bootstrap-responsive.min.css');
        $this->template->add_css('assets/libs/jquery_ui/jquery-ui-1.10.3.custom.min.css');
        $this->template->add_css('http://fonts.googleapis.com/css?family=Patrick+Hand');
        $this->template->add_css('assets/css/utils.css');
        $this->template->add_css('assets/css/admin.css');
        $this->template->add_js('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', 'import', 'header');
        $this->template->add_js('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        $this->template->add_js('window.jQuery || document.write("<script src=\"' . base_url('assets/js/vendor/jquery-1.10.1.min.js') . '\"><\/script>");', 'embed');
        $this->template->add_js('assets/libs/jquery_ui/jquery-ui-1.10.3.custom.min.js');
        $this->template->add_js('assets/js/vendor/bootstrap.min.js');
        $this->template->add_js('assets/js/vendor/jquery.blockUI.js');
        $this->load->library('form_validation');
    }

    /**
     * Checar los permisos del usuario
     */
    private function _check_permissions() {
        
    }

    /**
     * Renderiza el menu principal
     * @param string $active Item del menu que permanecera activo
     * @return void
     */
    protected function _init_nav() {
        if ($this->flexi_auth->is_admin()) {
            $this->_nav = array(
                'dashboard' => '<span class="glyphicon glyphicon-home"> Dashboard</span>',
                backend_slug('state') => '<span class="glyphicon glyphicon-home"> Estados</span>',
                backend_slug('activity') => '<span class="glyphicon glyphicon-home"> Actividades</span>',
                backend_slug('destination_touristic') => '<span class="glyphicon glyphicon-home"> Destinos turisticos</span>',
                'users' => '<span class="glyphicon glyphicon-user"> Usuarios</span>'
            );
        } else {
            $this->_nav = array(
                'dashboard' => '<span class="glyphicon glyphicon-home">Dashboard</span>'
            );
        }
    }

    /* Carga la plantilla por defecto junto con el javascript correspondiente
     * @param array $js_args argumentos a pasar a javascript
     */

    protected function _render($js_args = array()) {
        $this->template->add_js('assets/js/core.js');
        $this->template->add_js('assets/js/toolkit.js');
        $this->template->add_js('assets/js/admin.js');
        $js_args = array_merge($js_args, array('backend_slug' => backend_slug()));
        $this->_render_js($js_args);
        $this->_render_nav();
        $view = ($this->_module_name != $this->_controller_name) ? ($this->_module_name . '/admin/' . $this->_action_name) : ('admin/' . $this->_action_name);
        $this->template->build($view, $this->_data);
    }

    /**
     * Genera el menu principal
     * @return Object Instancia
     */
    protected function _render_nav() {
        $this->menu->reset();
        $this->menu->initialize(array('container_tag_class' => 'nav navbar-nav side-nav'));
        $this->template->nav($this->menu->render($this->_nav, $this->_nav_active), TRUE);
        return $this;
    }

}
