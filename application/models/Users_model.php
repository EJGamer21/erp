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
                'roles.rol, roles.level',
                'provincias.nombre as provincia',
                'ciudades.nombre as ciudad'
            ];
            $conditions = [
                'activo' => 1
            ];
            
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
            $this->db->join('usuarios_direcciones', 'usuarios.id = usuarios_direcciones.usuario_id');
            $this->db->join('direcciones', 'usuarios_direcciones.direccion_id = direcciones.id');
            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id');
            return $this->get(NULL, $fields, $conditions);
        }

        function getUser($id, $fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.email',
                'roles.rol, roles.level',
                'provincias.nombre as provincia',
                'ciudades.nombre as ciudad'
            ];
            
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
            $this->db->join('usuarios_direcciones', 'usuarios.id = usuarios_direcciones.usuario_id', 'left');
            $this->db->join('direcciones', 'usuarios_direcciones.direccion_id = direcciones.id', 'left');
            $this->db->join('provincias', 'direcciones.provincia_id = provincias.provincia_id');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.ciudad_id');
            return $this->get($id, $fields);
        }

        function getAllUsers($fields = array()) {
            $fields = [
                'usuarios.*',
                'emails.email',
                'roles.rol, roles.level',
                'provincias.nombre as provincia',
                'ciudades.nombre as ciudad'
            ];
            $this->db->join('emails', 'usuarios.email_id = emails.id', 'left');
            $this->db->join('roles', 'usuarios.role_id = roles.id');
            $this->db->join('usuarios_direcciones', 'usuarios.id = usuarios_direcciones.usuario_id', 'left');
            $this->db->join('direcciones', 'usuarios_direcciones.direccion_id = direcciones.id', 'left');
            $this->db->join('provincias', 'direcciones.provincia_id = provincias.provincia_id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.ciudad_id', 'left');
            return $this->get(NULL, $fields);
            // var_dump($this->get(NULL, $fields));
            // die;
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

        function deactivateUser($id) {
            $user_data = [
                'activo' => 0
            ];
            return $this->save($user_data, $id);
        }

        function activateUser($id) {
            $user_data = [
                'activo' => 1
            ];
            return $this->save($user_data, $id);
        }

        function deleteUser($id) {
            return $this->delete($id);
        }
    }