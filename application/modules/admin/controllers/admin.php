<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Admin extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->set_layout('auth');
        $this->load->helper('toolkit');
        $this->load->library('form_validation');
        $this->template->add_css('assets/css/normalize.css');
        $this->template->add_css('assets/css/bootstrap.min.css');
        $this->template->add_css('assets/css/auth.css');
        $this->template->add_js('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', 'import', 'header');
        $this->template->add_js('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        $this->template->set('message', $this->message->get());
    }

    public function index() {
        $this->_check_user();
        redirect('admin/login');
    }

    /**
     * Muestra el formulario de acceso
     * @return void
     */
    public function login() {
        $this->form_validation->set_rules('username', 'Usuario', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run()) {
            $username = clear_input('username');
            $password = clear_input('password');
            if ($this->flexi_auth->login($username, $password)) {
                $this->_check_user();
            }
            $this->message->set($this->flexi_auth->get_messages());
            $this->_check_user();
        }
        $this->template->build('login');
    }

    /**
     * Cierra la session activa
     * @return void
     */
    public function logout() {
        $this->flexi_auth->logout();
        $this->session->unset_userdata('copy');
        redirect(index_page());
    }

    /**
     * Comprueba si el usuario esta logueado, si es asi entonces lo redirecciona
     * @return void
     */
    protected function _check_user() {
        if ($this->flexi_auth->is_logged_in()) {
            redirect('dashboard');
        }
    }

    /**
     * Habilita el super usuario 
     */
    public function enable_admin() {
        $email = 'hgjuanramon@gmail.com';
        $username = 'juan';
        $password = 'juan';
        $user_data = array(
            'uacc_first_name' => 'Admin',
            'uacc_last_name' => 'istrador'
        );
        $group_id = 1;
        $activate = true;
        $user_id = $this->flexi_auth->insert_user($email, $username, $password, $user_data, $group_id, $activate);
        echo ($user_id) ? 'Habilitado' : 'Error';
    }

}
