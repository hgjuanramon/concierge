<?php
/**
 * Configure messages for the app
 * @author damaso
 */
class Message {
    private $_ci;
    private $_session_name = 'notify';
    
    public function __construct() {
        $this->_ci =& get_instance();
    }
    
    /**
     * Configura una notificacion
     * @param string $message Mensaje de la notificacion
     * @param string $type Tipo de notificacion [danger, success, info, error, warning]
     */
    public function set($message,$type=''){
        // Obtener lo que hay actualmente
        $curr_data = $this->_ci->session->flashdata($this->_session_name);
        $data = array();

        // Si hay datos en la session 
        if(!empty($curr_data) && $curr_data !== false){
            $data = $curr_data;
        }

        // Agregamos los nuevos datos
        array_push($data, array('type' => $type, 'message' => $message));
        $this->_ci->session->set_flashdata($this->_session_name, $data);
    }

    /**
     * Obtiene las notificaciones
     * @param  string $type tipo de mensaje especifico [danger, success, info, error, warning]
     * @return string Mensaje
     */
    public function get($type=''){

        // Session Messages
        $session_messages = $this->_ci->session->flashdata($this->_session_name);

        // Validation Messages
        $validation_messages = validation_errors();

        // Hold a Session Messages and Validation Mix
        $messages = array();

        // Validation Messages
        if(!empty($validation_messages) && $validation_messages !== false){
            $messages['danger'][] = array('type' => 'danger', 'message' => $validation_messages);
        }
        
        // Session Messages
        if(!empty($session_messages) && $session_messages !== false){
            foreach ($session_messages as $value) {
                $messages[$value['type']][] = $value;
            }
        }

        // Output HTML
        $output = '';

        if(empty($type)){
            // All messages
            
            foreach ($messages as $message_type => $value) {
                $output.='<div class="alert-container"><div class="alert alert-' . $message_type .'"><button type="button" class="close" data-dismiss="alert">&times;</button>';
                foreach ($value as $message) {
                    $output.= $message['message'];
                }
                $output.='</div></div>';
            }
        }else{
            // Specific Messages
            if(array_key_exists($type, $messages)){
                $output .= '<div class="alert-container"><div class="alert alert-' . $type .'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$messages[$type]['message'].'</div></div>';
            }
        }

        return $output;
    }

    /**
     * Set the message
     * @param string $message error,info,warning,succes
     * @param string $type 
     */
    public function set_alt($message,$type='error'){
        $this->_ci->session->set_flashdata('message_type', $type);
        $this->_ci->session->set_flashdata($this->_session_name,$message);
    }

    /**
     * Get the message
     * @param string type tipo de error
     * @return string
     */
    public function get_alt($type='error'){
        $message = (validation_errors()) ? validation_errors() : $this->_ci->session->flashdata($this->_session_name);
        if(empty($message)){
            return;
        }
        $type = ($this->_ci->session->flashdata('message_type')) ? $this->_ci->session->flashdata('message_type') : $type;
        return '<div class="' . $type .'">'. $message .'</div>';
    }
}