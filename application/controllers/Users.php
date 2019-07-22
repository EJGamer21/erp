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

	function register() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$code = $this->__createUserCode($firstname, $lastname);
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$sex = 'on';

			if ($this->input->post('sex') === $sex) {
				$sex = 1;
			} else {
				$sex = 0;
			}

			$user_form = [
				'codigo' => $code,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'sexo' => $sex,
				'username' => $this->input->post('username'),
				'fecha_creacion' => date('Y-m-d H:i:s')
			];
			$direction = [
				'province' => $this->input->post('province'),
				'city' => $this->input->post('city'),
				'sector' => $this->input->post('sector')
			];
			
			if ($this->Users->userExists($user_form['username']) === FALSE) {
				$user_form['email_id'] = $this->Emails->saveEmail($email);
				$user_form['direccion_id'] = $this->Directions->saveDirection($direction);
				$user_form['password'] = password_hash($password, PASSWORD_BCRYPT);
				$user_id = $this->Users->saveUser($user_form);
				$username = $this->Users->getUser($user_id, ['username']);
	
				return $username;
			} else {
				http_response_code(403);
				return FALSE;
			}
		} else {
			redirect(base_url('home'), 'location');
		}
	}

	private function __createUserCode($firstname, $lastname) {
		$shortenedName = strtoupper(substr($firstname, 0, 1).substr($lastname, 0, 1));
		$code = $shortenedName.'-'.date('Y-md');
		return $code;
	}
}