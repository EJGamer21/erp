<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function index()	{
		$data = $this->Users_model->getAllUsers();
		var_dump($data);

		$loader_data = [
            'title' => 'Usuarios',
            'view_name' => 'usuarios/index',
            'data' => [
				'users' => $data
			]
        ];
		$this->load->view("loader", $loader_data);
	}

	function view() {
		$id = $this->uri->segment(3);
		
		if (is_numeric($id)) {
			$data = $this->Users_model->getUser($id);
	
			$loader_data = [
				'title' => $data->nombre,
				'view_name' => 'usuarios/view',
				'data' => [
					'user' => $data
				]
			];
			$this->load->view("loader", $loader_data);
		} else {
			show_404();
		}
	}
}
