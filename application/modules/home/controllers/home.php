<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Home extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->_model = & $this->home_model;
        $this->_init();
    }

    public function index() {
        $this->_data['state_id'] = array(
            'name' => 'state_id',
            'attrs' => array('id' => 'state_id', 'class' => 'form-control'),
            //'label' => 'Estado',
            'value' => set_value('state_id'),
//            'options' => result_to_select( 'Seleccione Estado'),
            'type' => 'select'
        );
        $this->_data['city_id'] = array(
            'name' => 'city_id',
            'attrs' => array('id' => 'city_id', 'class' => 'form-control'),
            //'label' => 'Municipio',
            'value' => set_value('city_id'),
//            'options' => result_to_select( 'Seleccione municipio'),
            'type' => 'select'
        );
        $this->_data['mode_id'] = array(
            'name' => 'mode_id',
            'attrs' => array('class' => 'form-control'),
            //'label' => 'Transacción',
            'value' => set_value('mode_id'),
//            'options' => result_to_select( 'Seleccione operación'),
            'type' => 'select'
        );
        $this->_data['inmueble_type_id'] = array(
            'name' => 'inmueble_type_id',
            'attrs' => array('class' => 'form-control'),
            //'label' => 'Tipo inmueble',
            'value' => set_value('inmueble_type_id'),
//            'options' => result_to_select( 'Seleccione inmueble'),
            'type' => 'select'
        );
        $this->_data['from'] = array(
            'name' => 'from',
            'placeholder' => 'Desde',
            'class' => 'form-control',
            'value' => set_value('from'),
        );
        $this->_data['to'] = array(
            'name' => 'to',
            'placeholder' => 'Hasta',
            'class' => 'form-control',
            'value' => set_value('to'),
        );
        
        $this->_data['term'] = array(
            'name' => 'term',
            'placeholder' => 'Buscar por',
            'class' => 'form-control',
            'value' => set_value('term'),
        );
               $this->_render();
    }

    

}
