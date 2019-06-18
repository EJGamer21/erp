<?php 

class Usuarios extends CI_Controller {

    public function index() 
    {
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

    function register()
    {
        # code...
    }
}