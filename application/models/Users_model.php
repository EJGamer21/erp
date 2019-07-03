<?php
    class Users_model extends MY_Model {
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

        function getUsers($fields = array()) {
            return $this->get(NULL, $fields);
        }

        function getUser($id, $fields = array()) {
            return $this->get($id, $fields);
        }

        function getAllUsers() {
            return $this->get(NULL, $fields);
        }

        function login($data) {
            //TODO: finish login logic
        }

        private function _userExists() {
            //TODO: check if user already exists
        }
    }
