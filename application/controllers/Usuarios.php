<?php 

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UsersModel', 'um');
    }

    function index() {
        $data = $this->um->getUsers(['nombre', 'apellido']);

        $loader_data = [
            'title' => 'Usuarios',
            'view_name' => 'usuarios/index',
            'data' => [
                'users' => $data
            ]
        ];
        $this->load->view('loader', $loader_data);
        
    }

    function register() {
        # code...
    }
}