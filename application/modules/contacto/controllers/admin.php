<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contacto_model');
        $this->_model = & $this->contacto_model;
        $this->_data['section_title'] = 'Contacto';
        $this->load->helper('text');
        $this->_init();
    }

    public function index() {

        $this->template->set('rs', $this->_model->get_all());
        $this->template->set('message', $this->message->get());
        $this->template->set('headline', 'Contacto');
        $this->_render();
    }

    /**
     * Agregar un nuevo registro
     */
    public function add() {
        $this->_init_common();
    }

    /**
     * Editar los datos de un registro
     * @param int $id 
     */
    public function edit($id) {
        $record = $this->_get_record($id);
        $this->_init_common($record);
    }

    /**
     * Eliminar un registro
     * @param int $id 
     */
    public function delete($id) {
        $this->_model->delete($id);
        $this->message->set('Registro eliminado correctamente', 'info');
        redirect(backend_current_route());
    }

    /**
     * Iniciar procedimientos comunes
     * @param object $record 
     */
    private function _init_common($record = null) {
        $this->template->add_js('assets/libs/tinymce/tinymce.min.js');

        // Validar el formulario
        if ($this->_validate_form($record)) {
            $this->_save($record);
        }

        $this->_data['headline'] = 'Agregar';


        $informacion = clear_input('informacion');
        $lat = clear_input('lat');
        $lng = clear_input('lng');
        $facebook = clear_input('facebook');
        $twitter = clear_input('twitter');
        $youtube = clear_input('youtube');


        // Si estamos editando
        if (!empty($record)) {
            // Si aun no se envia el formulario tomar los datos de la tabla
            if (!$this->input->post()) {
                $this->_data['headline'] = 'Editar';
                $informacion = $record->informacion;
                $lat = $record->lat;
                $lng = $record->lng;
                $facebook = $record->facebook;
                $twitter = $record->twitter;
                $youtube = $record->youtube;
            }
            $this->_data['record'] = $record;
        }



        $this->_data['informacion'] = array(
            'name' => 'informacion',
            'id' => 'informacion',
            'class' => 'textInput textarea tinymce large editor',
            'label' => 'Información',
            'value' => set_value('informacion', $informacion),
            'type' => 'textarea',
            'rows' => 5
        );
        $this->_data['lat'] = array(
            'name' => 'lat',
            'label' => 'Latitud',
            'value' => set_value('lat', $lat),
        );
        $this->_data['lng'] = array(
            'name' => 'lng',
            'label' => 'Longitud',
            'value' => set_value('lng', $lng),
        );

        $this->_data['facebook'] = array(
            'name' => 'facebook',
            'label' => 'Facebook',
            'value' => set_value('facebook', $facebook),
        );
        $this->_data['youtube'] = array(
            'name' => 'youtube',
            'label' => 'Telefono',
            'value' => set_value('youtube', $youtube),
        );

        $this->_data['twitter'] = array(
            'name' => 'twitter',
            'label' => 'Twitter',
            'value' => set_value('twitter', $twitter),
        );



        $this->_data['message'] = $this->message->get();
        $this->_render_breadcrumb();
        $this->_render();
    }

    /**
     * Guardar o actualizar un registro
     * @param object $record datos del registro (si se esta editando)
     */
    private function _save($record = null) {

        $data = array(
            'informacion' => clear_input('informacion', false, false),
            'lat' => clear_input('lat'),
            'lng' => clear_input('lng'),
            'facebook' => clear_input('facebook'),
            'google_mas' => clear_input('google_mas'),
            'twitter' => clear_input('twitter'),
            'youtube' => clear_input('youtube')
        );

        // Obtener el ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};


        // Save or Update
        if (empty($record)) {
            $id = $this->_model->save($data);

            $this->message->set('Guardado correctamente', 'info');
        } else {
            $affected_rows = $this->_model->save($data, $id);
            $this->message->set('Actualizado correctamente', 'info');
        }

        redirect(backend_current_route() . 'edit/' . $id);
    }

    /**
     * Valida los datos del formulario
     * @param object $record datos del registro (si se esta editando)
     */
    private function _validate_form($record = null) {
        $this->form_validation->set_rules('informacion', 'Información', 'required');
        return $this->form_validation->run();
    }

    /**
     * Obtiene los datos del registro en caso de existir si no existe el registro 
     * o no es un id valido (que no sea del tipo esperado) envia un mensaje de error
     * @param int $id
     * @return object datos del registro 
     */
    private function _get_record($id) {
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_error('La pagina solicitada no pudo ser encontrada', 500, 'Pagina no encontrada');
        }
        $record = $this->_model->get_by_id($id);
        if (empty($record) || $record === false) {
            show_error('La pagina solicitada no pudo ser encontrada', 500, 'Pagina no encontrada');
        }
        return $record;
    }

    /**
     * Genera los breadcrumb de la pagina actual
     */
    protected function _render_breadcrumb() {
        $this->_breadcrumb = array(
            array('location' => 'Contacto', 'label' => 'Compañias'),
            array('location' => backend_current_route(), 'label' => 'Marcas'),
        );
        parent::_render_breadcrumb();
    }

}
