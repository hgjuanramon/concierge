<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_Controller extends MY_Controller {

    protected $_user;

    public function __construct() {
        parent::__construct();
        $this->load->library('flexi_auth');
    }

    protected function _init() {

        $this->template->title('Concierge');
        $this->load->model('home/home_model');
        $this->load->library('message');
        $this->load->helper('toolkit');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->template->add_css('assets/css/normalize.3.css');
        $this->template->add_css('assets/css/bootstrap.min.css');
        $this->template->add_css('assets/css/style.css');
        $this->template->add_css('assets/css/utils.css');
        $this->template->add_css('assets/css/font-awesome.min.css');
        $this->template->add_css('http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css');
        $this->template->add_css('https://fonts.googleapis.com/css?family=Rancho');
        $this->template->add_css('https://fonts.googleapis.com/css?family=Merriweather+Sans');
        $this->template->add_js('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', 'import', 'header');
        $this->template->add_js('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        $this->template->add_js('window.jQuery || document.write("<script src=\"' . base_url('assets/js/vendor/jquery-1.10.1.min.js') . '\"><\/script>");', 'embed');
        $this->template->add_css('assets/css/jquery-ui.css');
        $this->template->add_js('assets/js/vendor/jquery-ui.js');
        $this->template->add_js('assets/js/vendor/bootstrap.min.js');
        $this->template->add_js('assets/js/vendor/json2.js');
        $this->template->add_js('assets/js/vendor/responsiveslides.min.js');
        $this->template->add_css('https://fonts.googleapis.com/css?family=Bree+Serif');
        $this->_init_nav();
        $this->_build_header();


        if ($this->_controller_name == "home") {
            $this->template->add_css('assets/libs/slider/style.css');
            $this->template->add_js('assets/libs/slider/wowslider.js');
            $this->template->add_js('assets/libs/slider/script.js');
            $this->template->add_js('assets/libs/carrusel/jquery.bxslider.js');
            $this->template->add_css('assets/libs/carrusel/jquery.bxslider.css');
        }
        //$this->template->set('keywors', $this->home_model->get_keywors());
    }

    /**
     * Carga la plantilla por defecto junto con el javascript correspondiente
     * @param array $js_args argumentos a pasar a javascript
     */
    protected function _render($js_args = array()) {
        $this->template->add_js('assets/js/core.js');
        $this->template->add_js('assets/js/toolkit.js');
        $this->template->add_js('assets/js/main.js');
        $this->_render_js($js_args);
        $this->_render_nav();
        $this->template->build($this->_action_name, $this->_data);
    }

    protected function _render_nav() {
        $this->menu->reset();
        $this->menu->initialize(array('container_tag_class' => 'nav navbar-nav navbar-default'));
        $this->template->nav($this->menu->render($this->_nav, $this->_nav_active), TRUE);
        return $this;
    }

    protected function _build_header() {
        $this->template->set_partial('header', 'partials/header', $data);
        return $this;
    }

    protected function _init_nav() {
        $this->_nav = array(
            'home' => 'Inicio',
            'hoteles' => 'Hoteles',
            'events' => 'Eventos',
            'Routes' => 'Destinos turísticos',
            'atractivos' => 'Atractivos',
            'activities' => 'Actividades',
            'contacto' => 'Contacto',
            'about' => 'Nosotros',
        );
    }

}
