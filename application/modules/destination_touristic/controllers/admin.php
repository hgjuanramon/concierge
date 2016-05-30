<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('destination_touristic_model');
        $this->_model = & $this->destination_touristic_model;
        $this->_init();
        $this->_set_active_nav('admin/' . $this->_module_name);
        $this->template->title('Destinos turisticos');
    }

    public function index() {

        $page = $this->input->get('per_page');
        $where = array();

        $this->load->library('pagination');
        $params = array(
            'base_url' => base_url(backend_current_route(true)) . '?' . $this->_get_search_params(),
            'total_rows' => $this->_model->count(),
            'per_page' => 20,
            'page_query_string' => true
        );
        $this->pagination->initialize($params);

        $this->template->set('rs', $this->_model->get_by_page($params['per_page'], $page, $where));
        $this->template->set('headline', 'Listado destinos turisticos');
        $this->template->set('message', $this->message->get());
        $this->_render();
    }

    public function add() {
        $this->_init_common();
    }

    public function edit($id) {
        $record = $this->_get_record($id);
        $this->_init_common($record);
    }

    public function delete($id = '') {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $this->_model->delete($id);
        $this->message->set('Registro Eliminado correctamente');
        redirect(backend_current_route());
    }

    /**
     * Configurar cosas comunes
     * @param obj $record 
     */
    protected function _init_common($record = null) {

        // Validar el formulario
        if ($this->_validate_form($record)) {
            $this->_save($record);
        }

        $this->template->set('headline', 'Agregar');

        $name = clear_input('name');
        $description = clear_input('description');


        // Si estamos editando
        if (!empty($record)) {
            // Si aun no se envia el formulario tomar los datos de la tabla
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $name = $record->name;
                $description = $record->description;
            }
            $this->_data['record'] = $record;
        }


        $this->_data['name'] = array(
            'name' => 'name',
            'value' => set_value('name', $name),
            'label' => 'Nombre',
            'class' => 'form-control'
        );
        $this->_data['description'] = array(
            'name' => 'description',
            'value' => set_value('description', $description),
            'label' => 'Descripción',
            'class' => 'form-control editor',
            'type' => 'textarea',
            'rows' => 3
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

        $data = array(
            'name' => clear_input('name'),
            'description' => clear_input('description', false, false)
        );
        // Obtener el ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

//        $this->load->library('upload');
//        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
//            $rs_upload = $this->_upload_file('image');
//            if (isset($rs_upload['error'])) {
//                $this->message->set($rs_upload['error']);
//                redirect(get_current_route(true) . $id);
//            }
//            $user_data['uacc_image'] = $rs_upload['file_name'];
//        }
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
        redirect(backend_current_route() . 'edit/' . $id);
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

    protected function _render_breadcrumb() {
        $this->_breadcrumb = array(
            array('label' => 'Destinos turisticos', 'location' => backend_current_route()),
            array('label' => $this->template->headline, 'location' => '')
        );
        parent::_render_breadcrumb('current');
    }

    public function state($destination_id) {

        if (empty($destination_id) || !filter_var($destination_id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $this->template->set('rs_destination', $this->_get_record($destination_id));

        if ($this->input->post()) {

            $this->_model->delete_state($destination_id);
        }


        $this->template->set('rs_state', $this->_model->get_state($destination_id));
        $this->template->set('headline', 'Lista de estados');
        $this->template->title('Destino turístico - Estados');
        $this->_render();
    }

    public function save_state() {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('destination_state_id');
            $destination_id = $this->input->post('destination_touristic_id');
            $state_id = $this->input->post('state_id');
            $data = array(
                'destination_touristic_id' => $destination_id,
                'state_id' => $state_id
            );
            
            if(empty($destination_id)){
                exit(json_encode(array('retval' => false, 'msg' => 'Error ID destino')));
            }
            
            if (empty($id)) {
                $id = $this->_model->save_state($data);
                exit(json_encode(array('retval' => true, 'id' => $id)));
            } else {
                $this->_model->delete_state($id);
                exit(json_encode(array('retval' => true, 'id' => 0)));
            }
        }
    }

}
