<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        if (!$this->flexi_auth->is_admin()) {
            redirect('admin/dashboard');
        }
        $this->_table = 'state';
        $this->_keyfield = 'state_id';
        $this->_fields = '*';
    }

}
