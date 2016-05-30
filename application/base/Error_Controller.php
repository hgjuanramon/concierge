<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Error_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_init();
    }

    /**
     * Initialize the app
     */
    protected function _init() {
        $this->template->set_template('errors');
        switch ($this->_controller_name) {
            default:
                $this->template->add_css('assets/css/normalize.css');
                $this->template->add_css('assets/css/bootstrap.min.css');
                $this->template->add_css('assets/css/utils.css');
                $this->template->add_css('assets/css/main.css');
                $this->template->add_js('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', 'import', 'header');
                $this->template->add_js('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
                $this->template->add_js('window.jQuery || document.write("<script src=\"' . base_url('js/vendor/jquery-1.9.1.min.js') . '\"><\/script>");', 'embed');
                $this->template->add_js('assets/js/vendor/bootstrap.min.js');
                break;
        }
    }
    
    /**
    * carga la plantilla por defecto junto con el javascript correspondiente
    * @param array $js_args argumentos a pasar a javascript
    * @param string $active_nav indica el item del menu que estara activo
    */
    protected function _render($error) {
        $this->template->write_view('content', 'errors/' . $error);
        $this->template->render();
        /*
        $this->template->add_js('js/main.js');
        $this->template->add_js('app.init("'.$this->_controller_name.'", "'.$this->_method_name.'",'.((empty($js_args)) ? '""' : json_encode($js_args)).', "'. base_url() .'").run();', 'embed');        
        $this->template->write_view('content', $this->_views_folder . $this->_controller_name . '/' . $this->_method_name, $this->_data);
        $this->set_active_nav((empty ($active_nav) ? $this->_controller_name : $active_nav));
        $this->template->render();
         * 
         */
    }
}