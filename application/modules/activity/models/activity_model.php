<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        if (!$this->flexi_auth->is_admin()) {
            redirect('admin/dashboard');
        }
        $this->_table = 'cat_activity';
        $this->_keyfield = 'activity_id';
        $this->_fields = '*';
    }

}
