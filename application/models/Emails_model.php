<?php
    class Emails_model extends MY_Model {
        protected $_tablename = 'emails';
        // protected $belongs_to = [];

        function __construct() {
            parent::__construct();
        }

        function getEmails() {
            return $this->get();    
        }

        function getEmail($id) {
            return $this->get($id);
        }

        function emailExists($email) {
            $conditions = [
                'email' => $email
            ];
            
            $existingEmail = $this->get(NULL, ['email'], $conditions);

            if (empty($existingEmail)) {
                return FALSE;
            } else {
                return $existingEmail[0];
            }
        }

        function saveEmail($email, $id = NULL) {
            $data = [
                'email' => $email
            ];
            try {
                $this->db->trans_begin();

                $email_id = $this->save($data, $id);

                $this->db->trans_commit();
                    
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception ("Error creating user");
                } else {
                    $this->db->trans_commit();
                    return $email_id;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo "<script>console.log(".json_encode($e->message()).")</script>";
                return FALSE;
            }
            $data = [
                'email' => $email
            ];
            return $this->save($data, $id);
        }
    }
