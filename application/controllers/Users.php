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
            'data' => []
		];
		$this->load->view("loader", $loader_data);
	}

	function view() {
		$id = $this->uri->segment(3);
		
		if (is_numeric($id) && $id != 0 && $id > 0) {
			$user = $this->Users->getUser($id);

			$loader_data = [
				'title' => $user->firstname,
				'view_name' => 'users/view',
				'data' => [
					'userId' => $user->id
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

	function get() {
		$id = $this->uri->segment(3);
		header('Content-Type: application/json; chartset=utf-8');
		
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			if (is_numeric($id) && $id != 0 && $id > 0)  {
				$user = $this->Users->getUser($id);
			} else {
				$user = $this->Users->getAllUsers();
			}

			$json['response_code'] = 200;
			$json['status'] = $user ? 'OK' : 'Error';
			$json['response'] = $user;

			http_response_code(200);
			echo json_encode($json);
		} else {
			$json['response_code'] = 403;
			$json['status'] = 'Error';
			$json['response'] = 'Error 403: Acceso restringido.';
			http_response_code(403);
			echo json_encode($json);
		}
	}

	function getDirections() {
		header('Content-Type: application/json; chartset=utf-8');
		$json['provinces'] = $this->Directions->getProvinces();
		$json['cities'] = $this->Directions->getCities();

		http_response_code(200);
		echo json_encode($json);
	}


	/**
	 * Register a new user
	 * 
	 * @return json to ajax request
	 */

	function register() {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			// POST variables
			$id = ($this->input->post('id') === "") ? NULL : (int)($this->input->post('id'));
			$email = ($this->input->post('email') === "") ? NULL : $this->input->post('email');

			$user_form = [
				'id' => $id,
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'sexo' => $this->input->post('sex'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			];
			$direction = [
				'province' => $this->input->post('province'),
				'city' => $this->input->post('city')
			];

			// If all the direction inputs are empty then direction = null
			if (
				$direction['province'] == '' 
				&& $direction['city'] == ''
			) {
				$direction = NULL;
			}

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

			if (
				$user_form['firstname'] == '' 
				|| $user_form['lastname'] == ''
				|| $user_form['username'] == ''
				|| $user_form['password'] == ''
				|| $user_form['sexo'] == ''
			) {
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'success';
				$json['message'] = 'Campos no opcionales son requeridos.';
				
				http_response_code(400);
				echo json_encode($json);
				return;	
			}

			if (isset($id)) {

				$user_form['fecha_creacion'] = $this->input->post('fecha_creacion');
				$user_form['fecha_modificado'] = date('Y-m-d H:i:s');
				$user = $this->saveUser($user_form);	

				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'info';
				$json['message'] = 'Usuario actualizado existosamente.';
				$json['user'] = $user;
				$json['user_id'] = $user->id;
				
				http_response_code(200);
				echo json_encode($json);
				return;
			}

			// Check if user already exists			
			elseif ($this->Users->userExists($user_form['username']) === FALSE) {

				$user_form['fecha_creacion'] = date('Y-m-d H:i:s');
				$user = $this->saveUser($user_form);

				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'success';
				$json['message'] = 'Usuario creado existosamente.';
				$json['user'] = $user;
				$json['user_id'] = $user->id;
				
				http_response_code(200);
				echo json_encode($json);
				
				return;
			} else {
				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'error';
				$json['message'] = 'Usuario ya existente.';
				
				http_response_code(400);
				echo json_encode($json);
				return;
			}
		} else {
			// TODO: Manage if is registration from the user form or the register form
			header('Content-type: application/json; charset=utf-8');
			$json['status'] = 'Error';
			$json['message'] = 'Error 403: Acceso restringido.';
			
			http_response_code(403);
			echo json_encode($json);
			return;
		}
	}

	function toggleStatus() {

		$id = $this->uri->segment(3);
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (is_numeric($id) && $id != 0 && $id > 0) {
				
				$user = $this->Users->getUser($id);

				if ($user->activo == 1) {
					$this->Users->deactivateUser($user->id);
					$json['message'] = "Usuario '{$user->username}' desactivado.";
				} else {
					$this->Users->activateUser($user->id);
					$json['message'] = "Usuario '{$user->username}' activado.";
				}

				header('Content-type: application/json; charset=utf-8');
				$json['status'] = 'success';

				http_response_code(200);
				echo json_encode($json);
				return;

			} else {
				show_404();
			}
		} else {
			header('Content-type: application/json; charset=utf-8');
			$json['status'] = 'error';
			$json['message'] = 'Error 403: Acceso restringido.';
			
			http_response_code(403);
			echo json_encode($json);
			return;
		}
	}

	function removeUser() {

		$id = $this->uri->segment(3);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
			if (is_numeric($id) && $id != 0 && $id > 0) {
				$this->deleteUser($id);
			} else {
				show_404();	
			}
		} else {
			header('Content-type: application/json; charset=utf-8');
			$json['status'] = 'error';
			$json['message'] = 'Error 403: Acceso restringido.';
			
			http_response_code(403);
			echo json_encode($json);
			return;
		}
	}

	private function deleteUser($id) {
		$user = $this->Users->deleteUser($id);

		header('Content-type: application/json; charset=utf-8');
		$json['status'] = 'success';
		$json['message'] = 'Usuario eliminado correctamente.';
		$json['user_removed'] = $user;
		$json['user_removed_id'] = $id;

		http_response_code(200);
		echo json_encode($json);
		return;

	}

	private function saveUser($user_form) {
		$user_form['password'] = password_hash($user_form['password'], PASSWORD_BCRYPT);
		$user_id = $this->Users->saveUser($user_form, $user_form['id']);
		
		return $this->Users->getUser($user_id);
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