<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Destination_touristic_model extends Back_Model {

    public function __construct() {
        parent::__construct();
        if (!$this->flexi_auth->is_admin()) {
            redirect('admin/dashboard');
        }
        $this->_table = 'destination_touristic';
        $this->_keyfield = 'destination_touristic_id';
        $this->_fields = '*';
    }

    public function get_state($destination_id) {
        $rs = $this->db->select('state_id,name')->from('state')->get()->result();
        if (!empty($rs) || $rs !== false) {
            foreach ($rs as &$value) {
                $value->destination_state_id = $this->_get_check_state(array('state_id' => $value->state_id, 'destination_id' => $destination_id));
            }
        }
        return $rs;
    }

    protected function _get_check_state($where = array()) {
        $this->db->where('state_id', $where['state_id']);
        $this->db->where('destination_touristic_id', $where['destination_id']);
        $record = $this->db->select('*')->from('destination_state')->get()->row();
        return ($record) ? $record->destination_state_id : 0;
    }

    /**
     * Elimina un registro
     * @param int $id id del registro
     * @return int numero de registros afectados
     */
    public function delete_state($id) {
        $this->db->delete('destination_state', array('destination_state_id' => $id));
        return $this->db->affected_rows();
    }

    /**
     * Guardar o Actualizar
     * @param array $set
     * @param int $id
     * @return mixed ultimo id insertado | numero de registros afectados
     */
    public function save_state($set) {
        $this->db->insert('destination_state', $set);
        return $this->db->insert_id();
    }

}
