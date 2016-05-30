<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Back_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->_model = & $this->user_model;
        $this->_upload_path = FCPATH . 'uploads/perfil/';
        $this->_thumbs = array(
            array(
                'width' => 48,
                'height' => 48,
                'type' => 'crop',
            ),
            array(
                'width' => 150,
                'height' => 150,
                'type' => 'crop',
            ),
        );
        $this->_init();
    }

    public function index() {
        $this->template->set('rs', $this->_model->order_by('uacc_first_name', 'asc')->get_all());
        $this->template->set('headline', 'Listado de usuarios');
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
        $record = $this->user_model->get_by_id($id);
        if (empty($record) || $record === false) {
            show_404();
        }
        if ($id === 1) {
            show_error('Por cuestiones de seguridad no esta permitido modificar el super usuario del sistema', 500, 'No se puede eliminar el super usuario');
            exit;
        }
        $this->user_model->delete($id);
        $this->message->set('Registro Eliminado correctamente');
        redirect(get_current_route());
    }

    /**
     * Cambia el password del usuario logueado
     */
    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Password actual', 'required');
        $this->form_validation->set_rules('password', 'Nuevo password', 'required|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirme el password', 'required');
        if ($this->form_validation->run()) {
            $identity = $this->_user->uacc_username;
            $current_password = clear_input('current_password');
            $new_password = clear_input('password');
            $rs = $this->flexi_auth->change_password($identity, $current_password, $new_password);
            if ($rs) {
                $this->message->set($this->flexi_auth->get_messages());
            } else {
                $this->message->set($this->flexi_auth->get_messages(), 'info');
            }
            redirect(get_current_route(true));
        }
        $this->_data['current_password'] = array(
            'name' => 'current_password',
            'type' => 'password',
            'label' => 'Password actual',
            'value' => ''
        );
        $this->_data['password'] = array(
            'name' => 'password',
            'type' => 'password',
            'label' => 'Nuevo password',
            'value' => ''
        );
        $this->_data['password_confirm'] = array(
            'name' => 'password_confirm',
            'type' => 'password',
            'label' => 'Confirme el password',
            'value' => ''
        );
        $this->template->set('headline', 'Cambiar password');
        $this->template->set('message', $this->message->get());
        $this->_render();
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

        $first_name = clear_input('first_name');
        $last_name = clear_input('last_name');
        $email = clear_input('email');
        $username = clear_input('username');
        $group = clear_input('group');
        $id_plaza = clear_input('id_plaza');
        $phone = clear_input('phone');
        $cel_phone = clear_input('cel_phone');
        $is_root = false;

        // Si estamos editando
        if (!empty($record)) {
            // Si aun no se envia el formulario tomar los datos de la tabla
            if (!$this->input->post()) {
                $this->template->set('headline', 'Editar');
                $first_name = $record->uacc_first_name;
                $last_name = $record->uacc_last_name;
                $email = $record->uacc_email;
                $username = $record->uacc_username;
                $group = $record->uacc_group_fk;
                $phone = $record->uacc_phone;
                $cel_phone = $record->uacc_cel_phone;
                $id_plaza = $record->uacc_plaza_id;
                $image = $record->uacc_image;
            }
            $this->_data['record'] = $record;
            $is_root = ($record->uacc_id == 1) ? true : false;
        }

        // Si se trata de editar el superusuario
        $groups = ($is_root) ? result_to_select($this->_model->get_groups(true)) : result_to_select($this->_model->get_groups(), 'seleccione');
        $this->_data['group'] = array(
            'name' => 'group',
            'value' => set_value('group', $group),
            'label' => 'Grupo',
            'options' => $groups,
            'type' => 'select'
        );
        $this->_data['id_plaza'] = array(
            'name' => 'id_plaza',
            'value' => set_value('id_plaza', $id_plaza),
            'label' => 'Plaza',
            'options' => result_to_select($this->_model->get_plaza(), 'Seleccione'),
            'type' => 'select'
        );
        $this->_data['first_name'] = array(
            'name' => 'first_name',
            'value' => set_value('first_name', $first_name),
            'label' => 'Nombre'
        );
        $this->_data['last_name'] = array(
            'name' => 'last_name',
            'value' => set_value('last_name', $last_name),
            'label' => 'Apellidos'
        );
        $this->_data['email'] = array(
            'name' => 'email',
            'value' => set_value('email', $email),
            'label' => 'Email'
        );
        $this->_data['username'] = array(
            'name' => 'username',
            'value' => set_value('username', $username),
            'label' => 'Usuario'
        );
        $this->_data['password'] = array(
            'name' => 'password',
            'label' => 'Password',
            'type' => 'password',
            'hint' => (empty($record)) ? '' : 'Deje en blanco si no desea modificar'
        );
        $this->_data['password_confirm'] = array(
            'name' => 'password_confirm',
            'label' => 'Confirme el Password',
            'type' => 'password',
            'hint' => (empty($record)) ? '' : 'Deje en blanco si no desea modificar'
        );

        $this->_data['phone'] = array(
            'name' => 'phone',
            'value' => set_value('phone', $phone),
            'label' => 'Teléfono'
        );
        $this->_data['cel_phone'] = array(
            'name' => 'cel_phone',
            'value' => set_value('cel_phone', $cel_phone),
            'label' => 'Celular'
        );

        $this->_data['image'] = array(
            'name' => 'image',
            'class' => 'txtupload',
            'type' => 'file',
            'label' => (!empty($image)) ? anchor('uploads/perfil/' . $image, 'Ver', array('target' => '_blank')) : 'Seleccione Imagen',
            'hint' => '150x150'
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
        $email = clear_input('email');
        $username = clear_input('username');
        $password = clear_input('password');
        $group = clear_input('group');
        $user_data = array(
            'uacc_first_name' => clear_input('first_name'),
            'uacc_last_name' => clear_input('last_name'),
            'uacc_phone' => clear_input('phone'),
            'uacc_cel_phone' => clear_input('cel_phone'),
            'uacc_plaza_id' => clear_input('id_plaza'),
        );
        // Obtener el ID
        $id = (empty($record)) ? null : $record->{$this->_model->get_keyfield()};

        $this->load->library('upload');
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $rs_upload = $this->_upload_file('image');
            if (isset($rs_upload['error'])) {
                $this->message->set($rs_upload['error']);
                redirect(get_current_route(true) . $id);
            }
            $user_data['uacc_image'] = $rs_upload['file_name'];
        }
        // Save or Update
        if (empty($record)) {
            // Registrar el usuario
            $activate = true;
            $id = $this->flexi_auth->insert_user($email, $username, $password, $user_data, $group, $activate);
            if ($id === false) {
                $this->message->set($this->flexi_auth->get_messages(), 'error');
                redirect(get_current_route(true));
            }
            $this->message->set('Guardado correctamente', 'info');
        } else {
            // Actualizar
            $user_data['uacc_username'] = $username;
            $user_data['uacc_email'] = $email;
            if (!empty($password)) {
                $user_data['uacc_password'] = $password;
            }
            if (!$this->flexi_auth->update_user($id, $user_data)) {
                $this->message->set($this->flexi_auth->get_messages(), 'error');
                redirect(get_current_route(true) . $id);
            }
            $this->message->set('Actualizado correctamente', 'info');
        }
        redirect(get_current_route());
    }

    private function _validate_form($record = null) {
        $user_id = (empty($record)) ? null : $record->uacc_id;
        $this->form_validation->set_rules('group', 'Grupo', 'required');
        $this->form_validation->set_rules('id_plaza', 'Plaza', 'trim');
        $this->form_validation->set_rules('first_name', 'Nombre', 'required');
        $this->form_validation->set_rules('last_name', 'Apellidos', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Usuario', 'required|callback_username_available[' . $user_id . ']');
        $this->form_validation->set_rules('password', 'Password', 'callback_password_matches[' . $user_id . ']');
        return $this->form_validation->run();
    }

    /**
     * Username is available?
     * @param string $username
     * @param int $user_id
     * @return bool
     */
    public function username_available($username, $user_id) {
        if (!$this->user_model->username_available($username, $user_id)) {
            $this->form_validation->set_message('username_available', 'El usuario ya existe');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Passwords match?
     * @param string $password
     * @param int $user_id
     * @return bool
     */
    public function password_matches($password, $user_id) {
        $password_confirm = $this->input->post('password_confirm');
        if (empty($user_id)) {

            if (empty($password)) {
                $this->form_validation->set_message('password_matches', 'El campo Password es requerido');
                return FALSE;
            }

            // Cuando sea nuevo
            if ($password !== $password_confirm) {
                $this->form_validation->set_message('password_matches', 'Las contraseñas no coinciden');
                return FALSE;
            }
        } else {
            // Solo en caso de que se quiera cambiar el password
            if (!empty($password)) {
                if ($password !== $password_confirm) {
                    $this->form_validation->set_message('password_matches', 'Las contraseñas no coinciden');
                    return FALSE;
                }
            }
        }
        return TRUE;
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
            array('label' => 'Usuarios', 'location' => get_current_module()),
            array('label' => $this->template->headline, 'location' => '')
        );
        parent::_render_breadcrumb('current');
    }

}
