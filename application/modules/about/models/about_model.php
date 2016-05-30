<?php

class About_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'about';
        $this->_keyfield = 'about_id';
        $this->_fields = '*';
    }
    public function get_about(){
        return $this->db->select('*')->from('about')->get()->row();
    }
}
