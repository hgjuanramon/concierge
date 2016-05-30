<?php
if(!defined('BASEPATH')) exit('No direct access allowed');

class Dashboard extends Back_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->template->set('headline', 'Bienvenido');
		$this->_init();
		$this->_render();
	}	
}