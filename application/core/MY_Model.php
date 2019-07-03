<?php
    class MY_Model extends CI_Model {
        protected $_database;
        protected $_last_inserted_id;
        protected $_primary_key;
        protected $_fields = array();

        function __construct() {
            parent::__construct();
            $this->_database = $this->db;
            $this->_primary_key = 'id';
        }

        /**
         * Retrieve records from a given table
         * 
         * @param      int $id
         * @return     array $record(s)
         * 
        */

        protected function get($id = NULL, $fields = array()) {
            if (!$id) {
                return $this->_getAll($fields);
            }

            elseif ($id) {
                return $this->_getById($id, $fields);
            }

            else {
                throw new Exception("Id cannot be undefined");
            }
        }

        /**
         * Insert or update records on a given table
         * 
         * @param      int $id | array or object $data
         * @return     int $_last_inserted_id
         * 
        */

        function save($id = NULL, $data = NULL) {
            if (is_null($id) && !is_null($data)) {
                try {
                    $this->db->trans_begin();

                    $this->db->set($data);
                    $this->db->insert($this->_tablename);
                    $this->_last_inserted_id = $this->db->insert_id();

                    $this->db->trans_commit(); 
                    
                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception ("Error updating data in: ".$this->_tablename.". Error: ".$e->getMessage());
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }

                    return $this->_last_inserted_id;
                } catch(Exception $e) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }
            
            elseif (!is_null($id) && !is_null($data)) {
                try {
                    $this->db->trans_begin();

                    $this->db->set($data);
                    $this->db->where($this->_primary_key, $id);
                    $this->db->limit(1);
                    $this->db->update($this->_tablename);
                    $this->_last_inserted_id = $this->db->insert_id();

                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception ("Error updating data in: ".$this->_tablename.". Error: ".$e->getMessage());
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }

                    return $this->_last_inserted_id;
                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }
            
            else {
                throw new Exception("Id cannot be undefined");
            }
        }

        /**
         * Delete a record on a given table
         * 
         * @param       integer $id
         * @return      boolean
         * 
        */

        function delete($id = NULL) {
            $idToDelelete = NULL;

            if ($id) {
                $idToDelelete = $id;
                $this->_delete($idToDelelete);
                return TRUE;
            } else {
                throw new Exception("Id cannot be undefined");
                return FALSE;
            }
        }

        private function _delete($idToDelelete) {
            try {
                $this->db->trans_begin();
                $this->db->where($this->_primary_key, $idToDelelete);
                $this->db->limit(1);
                $this->db->delete($this->_tablename);

                if ($this->db->trans_status() === FALSE) {
                    throw new Exception ("Error deleting record in: ".$this->_tablename.". Error: ".$e->getMessage());
                } else {
                    $this->db->trans_commit();
                    return TRUE;
                }
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        private function _getAll($fields) {
            if (empty($fields)) {
                $this->db->select('*');
            } else {
                $fields = implode(",", $fields);
                $this->db->select("id, {$fields}");
            }

            $this->db->from($this->_tablename);
            $sql = $this->db->get();

            return $sql->result();
        }

        private function _getById($id, $fields) {
            if (empty($fields)) {
                $this->db->select('*');
            } else {
                $fields = implode(",", $fields);
                $this->db->select("id, {$fields}");
            }

            $this->db->from($this->_tablename);
            $this->db->where($this->_primary_key, $id);
            $sql = $this->db->get();

            return $sql->row(0);
        }

    }