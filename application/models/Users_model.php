<?php
    class Users_model extends MY_Model {
        protected $_tablename = 'usuarios';
        // protected $belongs_to = [];

        public $codigo;
        public $nombre;
        public $apellido;
        public $sexo;
        public $direccion_id;
        public $username;
        public $clave;
        public $email_id;
        public $fecha_creacion;
        public $fecha_modificado;

        function __construct() {
            parent::__construct();
        }

        function getUsers($fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.*'
            ];
            $conditions = [
                'activo' => 1
            ];
            
            $this->db->join('emails', 'usuarios.email_id = emails.id');
            return $this->get(NULL, $fields, $conditions);
        }

        function getUser($id, $fields = array()) {
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            return $this->get($id, $fields);
        }

        function getAllUsers($fields = array()) {
            $this->db->select("usuarios.*, emails.*");
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            return $this->get(NULL, $fields);
        }

        function login($data) {
            //TODO: finish login logic
        }

        function userExists($username) {
            $conditions = [
                'username' => $username
            ];

            $user = $this->get(NULL, ['id, username'], $conditions);

            if ($user) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function save($userData, $id = NULL) {
            //TODO: insert or update user
        }
    }
