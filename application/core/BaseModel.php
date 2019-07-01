<?php
    class BaseModel extends CI_Model {
        protected $_database;
        protected $primary_key;

        function __construct() {
            parent::__construct();
            $this->_database = $this->db;
            $this->primary_key = 'id';
        }

        function get($id = NULL) {
            if (!is_null($id)) {
                return $this->_getById($id);
            }

            elseif ($id == 0) {
                throw new Exception("Id cannot be undefined");
            }

            else {
                $this->_getAll();
            }
        }

        function save($id = NULL) {
            if (is_null($id)) {
                //$this->db->insert($data);
            }
            
            elseif ($id == 0) {
                throw new Exception("Id cannot be undefined");
            }
            
            else {
                //$this->db->update($id, $data);
            }
        }


        function _getAll($id) {
            $this->db->select('*');
            $this->db->from($this->_tablename);
            $sql = $this->db->get();

            return $sql->result();
        }

    }
?>