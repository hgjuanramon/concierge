<?php

class Atractivos extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('atractivos_model');
        $this->_model = & $this->atractivos_model;
        $this->template->title('Atractivos');
        $this->_init();
    }

    public function index() {
        $this->template->set('rs_state',$this->_model->get_state());
        $this->_render();
    }

}
