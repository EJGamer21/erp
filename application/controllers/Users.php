<?php 

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Users_model', 'Users');
		// $this->load->model('Emails_model', 'Emails');
		// $this->load->model('Directions_model', 'Directions');
    }

    public function index()	{
		$data = $this->Users->getUsers();

		$loader_data = [
            'title' => 'Users',
            'view_name' => 'users/index',
            'data' => [
				'users' => $data
			]
        ];
		$this->load->view("loader", $loader_data);
	}

	function view() {
		$id = $this->uri->segment(3);
		
		if (is_numeric($id) && $id != 0) {
			$data = $this->Users->getUser($id);

			$loader_data = [
				'title' => $data->nombre,
				'view_name' => 'users/view',
				'data' => [
					'user' => $data
				]
			];
			$this->load->view("loader", $loader_data);
		} else {
			show_404();
		}
	}

	function signup() {
		$loader_data = [
			'title' => 'Registrarse',
			'view_name' => 'users/register'
		];
		$this->load->view('loader', $loader_data);
	}

	function register() {
		$email = $this->input->post('email');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$sector = $this->input->post('sector');
		$pass = $this->input->post('password');
		$hashedPass = password_hash($pass, PASSWORD_BCRYPT);

		$userForm = [
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'sex' => $this->input->post('sex'),
			'username' => $this->input->post('username'),
			'password' => $hashedPass
		];
		$userForm['email'] = $this->Emails->insertEmail($email);
		$userForm['direccion'] = $this->Directions->insertDirection($province, $city, $sector);

		$user = $this->Users->get
	}
}