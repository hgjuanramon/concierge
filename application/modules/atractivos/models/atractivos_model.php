<?php

class Atractivos_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'attractive';
        $this->_keyfield = 'attractive_id';
        $this->_fields = '*';
    }
    public function get_state() {
        return $this->db->select('*')->from('state')->get()->result();
    }
}
