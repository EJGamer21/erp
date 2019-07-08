<?php
    class Emails_model extends MY_Model {
        protected $_tablename = 'usuarios';
        // protected $belongs_to = [];

        // public $codigo;
        // public $nombre;
        // public $apellido;
        // public $sexo;
        // public $direccion;
        // public $username;
        // public $clave;
        // public $email;
        // public $fecha_creacion;
        // public $fecha_modificado;

        function __construct() {
            parent::__construct();
        }

        function getEmails() {
            return $this->get();    
        }

        function getEmail($id) {
            return $this->get($id);
        }

        function save($data) {
            return $this->save($data);
        }
    }
