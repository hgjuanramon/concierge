<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Back_Model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_state() {
        return $this->db->select('state_id,name')->from('state')->get()->result_array();
    }

    public function get_city($state_id = null) {
        if (!empty($state_id)) {
            $this->db->where('state_id', $state_id);
        }
        return $this->db->select('city_id,name')->from('city')->get()->result_array();
    }

}
