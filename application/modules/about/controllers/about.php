<?php

class About extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('about_model');
        $this->_model = & $this->about_model;
        $this->template->title('Nosotros');
        $this->_init();
    }

    public function index() {
        $this->template->set('rs',  $this->_model->get_about());
        $this->_render();
    }

}
