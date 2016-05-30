<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'slider';
        $this->_keyfield = 'id_slider';
        $this->_fields="*";
    }
    
}