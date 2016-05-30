<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'user_accounts';
        $this->_keyfield = 'uacc_id';
    }
    
    /**
     * Validation for unique username
     * @param string $username
     * @param int $user_id
     * @return bool 
     */
    public function username_available($username, $user_id = null){
        $this->db->where('uacc_username', $username);
        if(!empty ($user_id)){
            $this->db->where('uacc_id !=', $user_id);
        }
        if($this->db->select('uacc_id')->from('user_accounts')->count_all_results() > 0){
            return false;
        }
        return true;
    }
    
    /**
     * Get all user groups
     * @param bool $root Flag indicate if is the root user
     * @return array
     */
    public function get_groups($root = false){
        if($root){
            return $this->db->select('ugrp_id,ugrp_desc')->get_where('user_groups', array('ugrp_id' => 1))->result_array();
        }else{
            return $this->db->select('ugrp_id,ugrp_desc')->get_where('user_groups', array('ugrp_admin !=' => 1))->result_array();  
        }
    }
    
    /**
     * Get all users
     * @param  array  $where Conditions
     * @return array
     */
    public function get_all($where = array()) {
        return $this->db->select('*')->get_where('user_accounts')->result();
    }
    /**
     * Get all plaza
     * @return type
     */
    public function get_plaza(){
        return $this->db->select('id_plaza, plaza')->from('cat_plaza')->get()->result_array();
    }


}