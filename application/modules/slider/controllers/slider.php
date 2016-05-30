<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Slider extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('slider_model');
        $this->_model = & $this->slider_model;
        $this->_upload_path = FCPATH . 'uploads/slider/';


        $this->_thumbs = array(
            array(
                'width' => 48,
                'height' => 48,
                'type' => 'crop',
            ),
            array(
                'width' => 1170,
                'height' => 550,
                'type' => 'crop'
            )
        );
        $this->_init();
    }

    public function index() {

        $nombre = $this->input->get('nombre');
        $page = $this->input->get('per_page'); // Offset
        // Condiciones
        $where = array();
        if (!empty($nombre)) {
            $this->_model->like('titulo', $nombre);
        }

        $this->load->library('pagination');
        $params = array(
            'base_url' => base_url(get_current_route(true)) . '?' . $this->_get_search_params(),
            'total_rows' => $this->_model->count($where),
            'per_page' => 50,
            'page_query_string' => TRUE
        );
        $this->pagination->initialize($params);

        // Search Form Fields
        $this->_data['nombre'] = array(
            'name' => 'nombre',
            'value' => set_value('nombre', $nombre),
            'id' => 'nombre'
        );
        

        if (!empty($nombre)) {
            $this->_model->like('titulo', $nombre);
        }

        $this->template->set('rs', $this->_model->order_by('id_slider')->get_by_page($params['per_page'], $page, $where));
        $this->template->set('headline', 'Listado de Imagenes');
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
        $this->_model->delete($id);
        if (!empty($record->imagen)) {
            $this->_remove_file($record->imagen);
        }
        $this->message->set('Registro eliminado', 'warning');
        redirect(get_current_route());
    }

    private function _init_common($record = null) {

        $this->template->add_js('assets/libs/tinymce/tinymce.min.js');

        if ($this->_validate_form($record)) {
            $this->_save($record);
        }

        $this->template->set('headline', 'Agregar');

        $titulo = clear_input('titulo');
        $status = clear_input('status');

        if (!empty($record)) {
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $titulo = $record->titulo;
                $status = $record->status;
            }
            $this->template->set('record', $record);
        }
        $this->_data['titulo'] = array(
            'name' => 'titulo',
            'label' => 'Titulo',
            'value' => set_value('titulo', $titulo)
        );
        $this->_data['imagen'] = array(
            'name' => 'imagen',
            'class' => 'txtupload',
            'type' => 'file',
            'label' => 'Seleccione una imágen',
            'hint' => '1024x450'
        );
        $this->_data['status'] = array(
            'name' => 'status',
            'value' => 1,
            'label' => 'Slider Miami',
            'type' => 'checkbox'
            
        );
        
        $this->template->set('message', $this->message->get());
        $this->_render_breadcrumb();
        $this->_render();
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

    private function _save($record = null) {

        $data = array(
            'titulo' => clear_input('titulo'),
        );

        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

        $this->load->library('upload');

        if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
            $rs_upload = $this->_upload_file('imagen');
            if (isset($rs_upload['error'])) {
                $this->message->set($rs_upload['error']);
                redirect(get_current_module() . $id);
            }
            $data['imagen'] = $rs_upload['file_name'];
        }

        if (empty($record)) {
            $id = $this->_model->save($data);
            $this->message->set('Se guardo correctamente los datos', 'info');
        } else {
            $this->_model->save($data, $id);
            $this->message->set('Datos actualizados correctamente', 'info');
        }
        redirect(get_current_route() . 'edit/' . $id);
    }

    private function _validate_form($record = null) {
        if (empty($record)) {
            $this->form_validation->set_rules('imagen', 'Imagen', 'file_required|file_allowed_type[image]');
        }
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        return $this->form_validation->run();
    }

    protected function _render_breadcrumb() {
        $this->_breadcrumb = array(
            array('label' => 'Slider', 'location' => get_current_module()),
            array('label' => $this->template->headline, 'location' => '')
        );
        parent::_render_breadcrumb('current');
    }
    public function change_status() {
        if ($this->input->is_ajax_request()) {
            $id_slider = $this->input->post('id');
            $value = $this->input->post('value');

            if (empty($id_slider)) {
                exit(json_encode(array('retval' => false, 'msg' => 'Ocurrio un error durante la petición')));
            }
            $this->_model->save(array('status' => $value), $id_slider);
            exit(json_encode(array('retval' => true, 'msg' => 'Cambio de estatus correctamente')));
        }
    }

}
