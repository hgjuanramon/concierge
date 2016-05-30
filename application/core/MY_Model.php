<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $_table;
    protected $_keyfield;
    protected $_fields;
    protected $_result = null;
    protected $_use_fieldnames = false;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Configura el campo llave
     * @param string $keyfield
     * @return Back_Model 
     */
    public function set_keyfield($keyfield){
        $this->_keyfield = $keyfield;
        return $this;
    }
    
    /**
     * Configura el nombre de la tabla
     * @param string $table
     * @return Back_Model 
     */
    public function set_table($table) {
        $this->_table = $table;
        return $this;
    }

    /**
     * Obtiene el nombre del campo llave
     * @return string
     */
    public function get_keyfield(){
        return $this->_keyfield;
    }
    
    /**
     * Obtiene el nombre de la tabla
     * @return string
     */
    public function get_table(){
        return $this->_table;
    }
    
    /**
     * Guardar o Actualizar
     * @param array $set
     * @param int $id
     * @return mixed ultimo id insertado | numero de registros afectados
     */
    public function save($set, $id = null) {
        if (empty($id)) {
            $this->db->insert($this->_table, $set);
            return $this->db->insert_id();
        } else {
            $this->db->update($this->_table, $set, array($this->_keyfield => $id), 1);
            return $this->db->affected_rows();
        }
    }

    /**
     * Elimina un registro
     * @param int $id id del registro
     * @return int numero de registros afectados
     */
    public function delete($id) {
        $this->db->delete($this->_table, array($this->_keyfield => $id), 1);
        return $this->db->affected_rows();
    }

    /**
     * Obtiene los datos de un registro
     * @param int $id
     * @return object
     */
    public function get_by_id($id) {
        if($this->_use_fieldnames){
            $this->db->select($this->_fields);
        }
        return $this->db->get_where($this->_table, array($this->_keyfield => $id), 1)->row();
    }
    
    /**
     * Obtiene los datos de una tabla
     * @param array $where condicion aplicada para los registros
     * @return result 
     */
    public function get_all($where = array()){
        if($this->_use_fieldnames){
            $this->db->select($this->_fields);
        }
        return $this->db->get_where($this->_table, $where)->result();
    }

    /**
     * Obtiene un rango de los registros (paginados)
     * @param int $limit
     * @param int $offset
     * @param array $where
     * @return object 
     */
    public function get_by_page($limit, $offset = '', $where = array()){
        if($this->_use_fieldnames){
            $this->db->select($this->_fields);
        }
        return $this->db->get_where($this->_table, $where, $limit, $offset)->result();
    }
    
    /**
     * Cuenta el numero de registros de una tabla
     * @return type 
     */
    public function count($where = array()){
        return $this->db->select($this->_keyfield)->from($this->_table)->where($where)->count_all_results();
    }
    
    /**
     * Agrega la instruccion order by a la sentencia actual
     * @param type $orderby
     * @param type $direction
     * @return \MY_Model 
     */
    public function order_by($orderby, $direction = 'ASC'){
        $this->db->order_by($orderby, $direction);
        return $this;
    }
    
    /**
     * Agrega la instruccion like a la sentencia actual
     * @param string $field  nombre del campo
     * @param string $match cadena a buscar
     * @param string $wildcard Si al inicio al final, ambos o ninguno before,after,both,none
     * @return \MY_Model Instancia
     */
    public function like($field, $match, $wildcard = 'both'){
        $this->db->like($field, $match, $wildcard);
        return $this;
    }
    
    /**
     * agregar la instruccion where a la sentencia actual
     * @param array $w Array de instrucciones where
     * @return \MY_Model 
     */
    public function where($w){
        $this->db->where($w);
        return $this;
    }
}