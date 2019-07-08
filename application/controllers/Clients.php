<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()	{
		$loader_data = [
            'title' => 'Inicio',
            'view_name' => 'dashboard',
            'data' => []
        ];
		$this->load->view("loader", $loader_data);
	}
}
