<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_Model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_keywors() {
        return $this->db->select('*')->from('tags')->get()->result();
    }

    public function get_redes_social() {

        $this->db->where('id_plaza', 0);
        return $this->db->select('*')->from('contacto')->get()->row();
    }

}
