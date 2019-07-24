<?php 

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Users_model', 'Users');
		$this->load->model('Emails_model', 'Emails');
		$this->load->model('Directions_model', 'Directions');
    }

    public function index()	{
		$users = $this->Users->getAllUsers();

		$loader_data = [
            'title' => 'Users',
            'view_name' => 'users/index',
            'data' => [
				'users' => $users,
				'directions' => [
					'provinces' => $this->Directions->getProvinces(),
					'cities' => $this->Directions->getCities(),
					'sectors' => $this->Directions->getSectors()
				]
			]
        ];
		$this->load->view("loader", $loader_data);
	}

	function view() {
		$id = $this->uri->segment(3);
		
		if (is_numeric($id) && $id != 0) {
			$data = $this->Users->getUser($id);

			$loader_data = [
				'title' => $data->firstname,
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


	/**
	 * Register a new user
	 * 
	 * @return json to ajax request
	 */

	function register() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			// POST variables
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$code = $this->__createUserCode($firstname, $lastname);
			$password = $this->input->post('password');
			$email = $this->input->post('email');

			$user_form = [
				'codigo' => $code,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'sexo' => $this->input->post('sex'),
				'username' => $this->input->post('username'),
				'fecha_creacion' => date('Y-m-d H:i:s')
			];
			$direction = [
				'province' => $this->input->post('province'),
				'city' => $this->input->post('city'),
				'sector' => $this->input->post('sector')
			];

			// Check if user already exists			
			if ($this->Users->userExists($user_form['username']) === FALSE) {
				$user_form['email_id'] = $this->Emails->saveEmail($email);
				$user_form['direccion_id'] = $this->Directions->saveDirection($direction);
				$user_form['password'] = password_hash($password, PASSWORD_BCRYPT);
				$user_id = $this->Users->saveUser($user_form);
				$username = $this->Users->getUser($user_id, ['username']);
				
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'success';
				$json['message'] = 'Usuario creado existosamente';
				echo json_encode($json);

				return $username;
			} else {
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'error';
				$json['message'] = 'Usuario ya existente';

				echo json_encode($json);
			}
		} else {
			// manage if is registration from the user form or the register form
			header('Content-type: application/json; charset=utf-8');
			$json['status'] = 'error';
			$json['message'] = 'Error 403: Acceso restringido';
			echo json_encode($json);
			redirect('/users');
		}
	}


	/**
	 * Helper function to create the user code
	 * 
	 * @param string firstname and lastname of the user
	 * @return string formatted user code
	 */

	private function __createUserCode($firstname, $lastname) {
		$shortenedName = strtoupper(substr($firstname, 0, 1).substr($lastname, 0, 1));
		$code = $shortenedName.'-'.date('Y-md');
		return $code;
	}
}