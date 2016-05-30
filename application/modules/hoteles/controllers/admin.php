<?php

class admin extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('destination_touristic/destination_touristic_model');
        $this->load->model('hotel_model');
        $this->_model = & $this->hotel_model;
        $this->_init();
        $this->template->title('Hoteles');
        $this->_set_active_nav('admin/destination_touristic');
        $this->_upload_path = FCPATH . 'uploads/hotel/logo/';
        $this->_thumbs = array(
            array(
                'width' => 48,
                'height' => 48,
                'type' => 'crop'
            ),
            array(
                'width' => 100,
                'height' => 100,
                'type' => 'crop'
            ),
            array(
                'width' => 200,
                'height' => 200,
                'type' => 'crop'
            )
        );
    }

    public function index($destination_id) {

        if (empty($destination_id) || !filter_var($destination_id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $page = $this->input->get('per_page');
        $where = array();

        $this->load->library('pagination');
        $params = array(
            'base_url' => base_url(get_current_route(true)) . '?' . $this->_get_search_params(),
            'total_rows' => $this->_model->count($where),
            'per_page' => 20,
            'page_query_string' => true
        );
        $this->pagination->initialize($params);
        $this->template->set('rs', $this->_model->get_by_page($params['per_page'], $page, $where));
        $this->template->set('rs_destination', $this->_get_record_destination($destination_id));
        $this->template->set('headline', 'Hoteles');
        $this->template->set('message', $this->message->get());
        $this->_render();
    }

    public function add($destination_id) {
        $rs_destination = $this->_get_record_destination($destination_id);
        $this->_init_common($rs_destination);
    }

    public function edit($destination_id, $id) {
        $record = $this->_get_record($id);
        $rs_destination = $this->_get_record_destination($destination_id);
        $this->_init_common($rs_destination, $record);
    }

    public function delete($id = '') {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->_get_record($id);
        if (empty($record)) {
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
    protected function _init_common($rs_destination, $record = null) {

        $this->template->set('rs_destination', $rs_destination);
        // Validar el formulario
        if ($this->_validate_form($record)) {
            $this->_save($record);
        }

        $this->template->set('headline', 'Agregar');

        $name = clear_input('name');
        $description = clear_input('description');
        $state_id = clear_input('state_id');
        $city_id = clear_input('city_id');
        $city = array();

        // Si estamos editando
        if (!empty($record)) {
            // Si aun no se envia el formulario tomar los datos de la tabla
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $state_id = $record->state_id;
                $city_id = $record->city_id;
                $name = $record->name;
                $description = $record->description;
                $map = $record->map;
                $logo = $record->logo;
            }
            $this->_data['record'] = $record;
            if (!empty($state_id)) {
                $city = $this->_model->get_city($state_id);
            }
        }
        if ($this->input->post()) {
            if (!empty($state_id)) {
                $city = $this->_model->get_city($state_id);
            }
        }

        $this->_data['name'] = array(
            'name' => 'name',
            'value' => set_value('name', $name),
            'label' => 'Nombre',
            'class' => 'form-control'
        );

        $this->_data['state_id'] = array(
            'name' => 'state_id',
            'value' => set_value('state_id', $state_id),
            'label' => 'Estado',
            'options' => result_to_select($this->_model->get_state(), 'Seleccione'),
            'type' => 'select',
            'attrs' => array('id' => 'state_id', 'class' => 'form-control')
        );
        $this->_data['city_id'] = array(
            'name' => 'city_id',
            'value' => set_value('city_id', $city_id),
            'label' => 'Ciudad',
            'options' => result_to_select($city),
            'type' => 'select',
            'attrs' => array('id' => 'city_id', 'class' => 'form-control')
        );


        $this->_data['map'] = array(
            'name' => 'map',
            'value' => set_value('map', $map),
            'label' => 'Ubicación',
            'placeholder' => '19.09777, -19.88987',
            'class' => 'form-control'
        );
        $this->_data['logo'] = array(
            'name' => 'logo',
            'value' => set_value('logo', $logo),
            'label' => ($logo) ? anchor(base_url() . 'uploads/hotel/logo/' . $logo, img('uploads/hotel/logo/48x48_' . $logo), array('target'=>'_blank')) : 'Logo',
            'type' => 'file'
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

        $destination_id = $this->template->rs_destination->destination_touristic_id;

        $data = array(
            'destination_touristic_id' => $destination_id,
            'state_id' => clear_input('state_id'),
            'city_id' => clear_input('city_id'),
            'name' => clear_input('name'),
            'description' => clear_input('description', false, false)
        );
        // Obtener el ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

        $this->load->library('upload');
        if (isset($_FILES['logo']) && !empty($_FILES['logo']['name'])) {
            $rs_upload = $this->_upload_file('logo');
            if (isset($rs_upload['error'])) {
                $this->message->set($rs_upload['error']);
                redirect(backend_current_route(true) . $destination_id . '/' . $id);
            }
            $data['logo'] = $rs_upload['file_name'];
        }
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
        redirect(backend_current_route() . 'edit/' . $destination_id . '/' . $id);
    }

    private function _validate_form($record = null) {
        if (empty($record)) {
            $this->form_validation->set_rules('logo', 'Logotipo', 'file_required|file_allowed_type[image]');
        }
        $this->form_validation->set_rules('name', 'Nombre Hotel', 'required');
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

    private function _get_record_destination($id) {
        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->destination_touristic_model->get_by_id($id);
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

    public function get_city() {
        if ($this->input->is_ajax_request()) {
            $state_id = $this->input->post('state_id');
            if (empty($state_id) || !filter_var($state_id, FILTER_VALIDATE_INT)) {
                exit(json_encode(array('retval' => false, 'msg' => 'Erro Id')));
            }

            $record = $this->_model->get_city($state_id);

            $html = result_to_select($record, 'Seleccione', 'html');
            exit(json_encode(array('retval' => true, 'html' => $html)));
        }
    }

}
