<?php

class Admin extends Back_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('about_model');
        $this->_model = &$this->about_model;
        $this->load->helper('text');

        $this->_upload_path = FCPATH . 'uploads/about/';
        $this->_thumbs = array(
            array(
                'width' => 48,
                'height' => 48,
                'type' => 'crop'
            ),
            array(
                'width' => 250,
                'height' => 250,
                'type' => 'crop'
            ),
            array(
                'width' => 350,
                'height' => 300,
                'type' => 'resize',
                'ratio' => true
            ),
        );
        $this->template->title('Nosotros');
        $this->_set_active_nav('admin/about');
        // Init Common Settings     
        $this->_init();
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
//        $this->template->set('rs', $this->_model->order_by('promotion_id', 'desc')->get_by_page($params['per_page'], $page, $where));
        $this->template->set('headline', 'Nosotros');
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

    public function delete($id) {
        $record = $this->_get_record($id);

        if (empty($record) && $record !== false) {
            show_404();
        }
        $this->_model->delete($id);
        if (!empty($record->image)) {
            $this->_delete_file($record->image);
        }

        $this->message->set('Registro eliminado correctamente', 'success');
        redirect(backend_current_route());
    }

    protected function _init_common($record = null) {
        $this->template->add_js('assets/libs/tinymce/tinymce.min.js');
        if ($this->_validate_form($record)) {
            $this->_save($record);
        }
        $this->template->set('headline', 'Agregar');

        $title = clear_input('title');
        $description = clear_input('description');
        $image = clear_input('image');


        if (!empty($record)) {
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $title = $record->title;
                $description = $record->description;
                $image = $record->image;
            }
            $this->template->set('record', $record);
        }
        $this->_data['title'] = array(
            'name' => 'title',
            'value' => set_value('title', $title),
            'label' => 'Titulo',
            'class' => 'form-control',
        );

        $this->_data['description'] = array(
            'name' => 'description',
            'value' => set_value('description', $description),
            'label' => 'Descripción',
            'class' => 'form-control editor',
            'type' => 'textarea',
            'rows' => 5
        );

        $this->_data['image'] = array(
            'name' => 'image',
            'value' => set_value('image'),
            'label' => (!empty($image)) ? img(array('src' => 'uploads/about/48x48_' . $image)) : 'Imagen',
            'type' => 'file'
        );


        $this->template->set('message', $this->message->get());
        $this->_render();
    }

    public function _save($record = null) {

        $data = array(
            'title' => clear_input('title'),
            'description' => clear_input('description', false, false),
        );
        // Get the keyfield ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

        $this->load->library('upload');

        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $rs_upload = $this->_upload_file('image');
            if (isset($rs_upload['error'])) {
                $this->message->set($rs_upload['error']);
                redirect(backend_current_route(true) . $id);
            }
            $data['image'] = $rs_upload['file_name'];
        }
        if (empty($record)) {

            $id = $this->_model->save($data);
            $this->message->set('Se guardo correctamente los datos', 'info');
        } else {
            $this->_model->save($data, $id);
            $this->message->set('Datos actualizados correctamente', 'info');
        }

        redirect(backend_current_route() . 'edit/' . $id);
    }

    protected function _get_record($id) {

        if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
            show_404();
        }
        $record = $this->_model->get_by_id($id);
        if (empty($record) || $record === false) {
            show_404();
        }
        return $record;
    }

    private function _validate_form($record = null) {

        if (empty($record)) {
            $this->form_validation->set_rules('image', 'Imagen', 'file_required|file_allowed_type[image]');
        }

        $this->form_validation->set_rules('title', 'Titulo', 'required');
        $this->form_validation->set_rules('description', 'Descripción', 'trim');
        return $this->form_validation->run();
    }

}
