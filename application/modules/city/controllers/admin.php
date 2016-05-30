<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('city_model');
        $this->_model = & $this->city_model;
        $this->_init();
        $this->_set_active_nav('admin/' . $this->_module_name);
        $this->template->title('Lista ciudades');
    }

    public function index($state_id) {

        if (empty($state_id) || !filter_var($state_id, FILTER_VALIDATE_INT)) {
            show_alert('Error ID');
        }

        $this->template->set('rs_state', $this->_get_record_state($state_id));

        $page = $this->input->get('per_page');
        $where = array(
            'state_id' => $state_id
        );

        $this->load->library('pagination');
        $params = array(
            'base_url' => base_url(backend_current_route(true)) . '?' . $this->_get_search_params(),
            'total_rows' => $this->_model->count($where),
            'per_page' => 20,
            'page_query_string' => true
        );
        $this->pagination->initialize($params);

        $this->template->set('rs', $this->_model->get_by_page($params['per_page'], $page, $where));
        $this->template->set('headline', 'Listado ciudades');
        $this->template->set('message', $this->message->get());
        $this->_render();
    }

    public function add($state_id) {
        $rs_state = $this->_get_record_state($state_id);
        $this->_init_common($rs_state);
    }

    public function edit($state_id, $id) {
        $rs_state = $this->_get_record_state($state_id);
        $record = $this->_get_record($id);
        $this->_init_common($rs_state, $record);
    }

    public function delete($id = '') {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->_get_record($id);
        if (empty($record) && $record === false) {
            show_404();
        }
        $this->_model->delete($id);
        $this->message->set('Registro Eliminado correctamente');
        redirect(backend_current_route() . 'index/' . $record->state_id);
    }

    /**
     * Configurar cosas comunes
     * @param obj $record 
     */
    protected function _init_common($rs_state, $record = null) {

        $this->template->set('rs_state', $rs_state);
        // Validar el formulario
        if ($this->_validate_form($record)) {
            $this->_save($record);
        }

        $this->template->set('headline', 'Agregar');

        $name = clear_input('name');

        // Si estamos editando
        if (!empty($record)) {
            // Si aun no se envia el formulario tomar los datos de la tabla
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $name = $record->name;
            }
            $this->_data['record'] = $record;
        }


        $this->_data['name'] = array(
            'name' => 'name',
            'value' => set_value('name', $name),
            'label' => 'Ciudad',
            'class' => 'form-control'
        );

        $this->template->set('message', $this->message->get());
        $this->_render_breadcrumb();
        $this->_render();
    }

    /**
     * Guardar o actualizar un registro, Nota el superusuario (root) no puede cambiar su grupo
     * @param object $record datos del registro (si se esta editando)
     */
    private function _save($record = null) {
        $state_id = $this->template->rs_state->state_id;
        $data = array(
            'state_id' => $state_id,
            'name' => clear_input('name'),
        );
        // Obtener el ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

        // Save or Update
        if (empty($record)) {
            // Registrar el usuario
            $id = $this->_model->save($data);
            $this->message->set('Guardado correctamente', 'info');
        } else {
            // Actualizar
            $this->_model->save($data, $id);
            $this->message->set('Actualizado correctamente', 'info');
        }
        $this->_model->save(array('slug' => enhanced_url_title($data['name'] . '-' . $id, 'dash', TRUE)), $id);
        redirect(backend_current_route() . 'edit/' . $state_id . '/' . $id);
    }

    private function _validate_form($record = null) {
        $this->form_validation->set_rules('name', 'Nombre estado', 'required');
        return $this->form_validation->run();
    }

    private function _get_record($id) {
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->_model->get_by_id($id);
        if (empty($record) || $record === false) {
            show_404();
        }
        return $record;
    }

    private function _get_record_state($id) {
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->_model->get_state_id($id);
        if (empty($record) || $record === false) {
            show_404();
        }
        return $record;
    }

    protected function _render_breadcrumb() {
        $this->_breadcrumb = array(
            array('label' => 'Ciudades', 'location' => backend_current_route()),
            array('label' => $this->template->headline, 'location' => '')
        );
        parent::_render_breadcrumb('current');
    }

}
