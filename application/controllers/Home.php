<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$info = [
			'view_name' => 'dashboard',
			'title' => 'Inicio',
			'data' => [
				'user' => [
					'name' => 'Enger'
				],
				'page' => [
					'title' => 'Titulo'
				]
			]
		];
		$this->load->view("loader", $info);
	}
}
