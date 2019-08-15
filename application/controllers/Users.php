<?php 

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Users_model', 'Users');
		$this->load->model('Emails_model', 'Emails');
		$this->load->model('Directions_model', 'Directions');
    }

    public function index()	{

		$loader_data = [
            'title' => 'Users',
            'view_name' => 'users/index',
            'data' => [
				'users' => $this->Users->getAllUsers(),
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
			$user = $this->Users->getUser($id);

			$loader_data = [
				'title' => $user->firstname,
				'view_name' => 'users/view',
				'data' => [
					'user' => $user
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
			$password = $this->input->post('password');
			$email = ($this->input->post('email') === "") ? NULL : $this->input->post('email');

			$user_form = [
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'sexo' => $this->input->post('sex'),
				'username' => $this->input->post('username'),
				'fecha_creacion' => date('Y-m-d H:i:s')
			];
			$direction = [
				'province' => $this->input->post('province'),
				'city' => $this->input->post('city'),
				'sector' => $this->input->post('sector')
			];

			// If all the direction inputs are empty then direction = null
			if ($direction['province'] == '' && $direction['city'] == '' && $direction['sector'] == '') {
				$direction = NULL;
			}

			// Check if user already exists			
			if ($this->Users->userExists($user_form['username']) === FALSE) {

				// If email is not sent empty
				if ($email !== NULL) {
					// Check if email already exists
					if ($this->Emails->emailExists($email) === FALSE) {

						//If email does not exists, then insert it
						$user_form['email_id'] = $this->Emails->saveEmail($email);
					} else {

						//If email already exists, use the existing email id
						$user_form['email_id'] = $this->Emails->emailExists($email)->id;
					}
				}
				
				// If direction is null not insert a new direction
				if ($direction !== NULL) {

					if ($this->Directions->directionExists($direction) === FALSE) {
						//If direction does not exists, then insert it
						$user_form['direccion_id'] = $this->Directions->saveDirection($direction);
					} else {
						//If direction already exists, use the existing direction id						
						$user_form['direccion_id'] = $this->Directions->saveDirection($direction)->id;
					}
				}

				$user_form['password'] = password_hash($password, PASSWORD_BCRYPT);
				$user_id = $this->Users->saveUser($user_form);
				$user = $this->Users->getUser($user_id);
				
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'success';
				$json['message'] = 'Usuario creado existosamente';
				$json['user'] = $user;
				
				echo json_encode($json);
				http_response_code(200);

				// return $user;
			} else {
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'error';
				$json['message'] = 'Usuario ya existente';
				
				echo json_encode($json);
				// http_response_code(400);
			}
		} else {
			// manage if is registration from the user form or the register form
			header('Content-type: application/json; charset=utf-8');
			$json['status'] = 'error';
			$json['message'] = 'Error 403: Acceso restringido';
			
			echo json_encode($json);
			http_response_code(403);
		}
	}


	/**
	 * Helper function to create the user code
	 * 
	 * @param string firstname and lastname of the user
	 * @return string formatted user code
	 * 
	 * 	private function __createUserCode($firstname, $lastname) {
	 *		$shortenedName = strtoupper(substr($firstname, 0, 1).substr($lastname, 0, 1));
	 *		$code = $shortenedName.'-'.date('Y-md');
	 *		return $code;
	 *	}
	 * deprecated...
	*/



}