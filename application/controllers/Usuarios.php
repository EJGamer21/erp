<?php 

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
    }

    function index() {
        $info = [
            'title' => 'Usuarios',
            'view_name' => 'usuarios/index',
            'data' => [
                'user' => [
                    'name' => 'Enger'
                ],
                'miembros' => ('Enger, Jose, Pepe')
            ]
        ];
        $this->load->view('loader', $info);
        
    }

    function register() {
        # code...
    }
}