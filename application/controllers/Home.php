<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Users_model', 'users');
	}

	public function index()	{
		// if ($this->users->isLoggedIn()) {
		// 	redirect($this->dashboard(), 'auto', );
		// }
		$loader_data = [
            'title' => 'Inicio',
            'view_name' => 'dashboard',
            'data' => []
        ];
		$this->load->view("loader", $loader_data);
	}
}
