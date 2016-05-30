<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        if (!$this->flexi_auth->is_admin()) {
            redirect('admin/dashboard');
        }
        $this->_table = 'city';
        $this->_keyfield = 'city_id';
        $this->_fields = '*';
    }

    public function get_state_id($state_id) {
        $this->db->where('state_id', $state_id);
        return $this->db->select('*')->from('state')->get()->row();
    }

}
