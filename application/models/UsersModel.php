<?php
    class UsersModel extends BaseModel {
        protected $_tablename = 'usuarios';
        // protected $belongs_to = [];

        public $codigo;
        public $nombre;
        public $apellido;
        public $sexo;
        public $direccion;
        public $username;
        public $clave;
        public $email;
        public $fecha_creacion;
        public $fecha_modificado;

        function __construct() {
            parent::__construct();

        }

        function getUsers() {
            return $this->get();
        }

        function getUser($id) {
            return $this->get($id);
        }

        function login($data) {
            //TODO: finish login logic
        }

        private function _userExists() {
            //TODO: check if user already exists
        }
    }
