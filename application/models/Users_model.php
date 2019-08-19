<?php
    class Users_model extends MY_Model {
        protected $_tablename = 'usuarios';
        // protected $belongs_to = [];

        function __construct() {
            parent::__construct();
        }

        function getUsers($fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.email',
                'roles.rol, roles.level'
            ];
            $conditions = [
                'activo' => 1
            ];
            
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
            return $this->get(NULL, $fields, $conditions);
        }

        function getUser($id, $fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.email',
                'roles.rol, roles.level'
            ];
            
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
            return $this->get($id, $fields);
        }

        function getAllUsers($fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.email',
                'roles.rol, roles.level'
            ];
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
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

        function saveUser($user_data, $id = NULL) {
            try {
                $this->db->trans_begin();

                $user = $this->save($user_data, $id);

                $this->db->trans_commit();
                    
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception ("Error creating user");
                } else {
                    $this->db->trans_commit();
                    return $user;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo json_encode($e->message());
                return FALSE;
            }
        }
    }