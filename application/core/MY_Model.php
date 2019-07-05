<?php
    class MY_Model extends CI_Model {
        protected $_database;
        protected $_last_inserted_id;
        protected $_primary_key;
        protected $_fields = array();
        protected $_conditions = array();

        function __construct() {
            parent::__construct();
            $this->_database = $this->db->database;
            $this->_primary_key = 'id';
        }

        /**
         * Retrieve records from a given table
         * 
         * @param      int $id
         * @return     array $record(s)
         * 
        */

        protected function get($id = NULL, $fields = array(), $conditions = array()) {
            $this->_fields = $fields;
            $this->_conditions = $conditions;
            
            if ($this->_conditions) {
                return $this->_getWhere();
            }
            
            else {
                if (!$id) {
                    return $this->_getAll();
                }
    
                elseif ($id) {
                    return $this->_getById($id);
                }
    
                else {
                    throw new Exception("Id cannot be undefined");
                }
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
            // Insert new record
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
                        return $this->_last_inserted_id;
                    }

                } catch(Exception $e) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }
            
            // Update existing record
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
                        return FALSE;
                    } else {
                        $this->db->trans_commit();
                        return $this->_last_inserted_id;
                    }

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
                if ($this->_delete($idToDelelete)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
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

        private function _getAll() {

            if (empty($this->_fields)) {
                $this->db->select('*');
            } else {
                $this->_fields = implode(",", $this->_fields);
                $this->db->select("id, {$this->_fields}");
            }

            $this->db->from($this->_tablename);
            $sql = $this->db->get();

            return $sql->result();
        }

        private function _getById($id) {

            if (empty($this->_fields)) {
                $this->db->select('*');
            } else {
                $this->_fields = implode(",", $this->_fields);
                $this->db->select("id, {$this->_fields}");
            }


            $this->db->from($this->_tablename);
            $this->db->where($this->_primary_key, $id);
            $sql = $this->db->get();

            return $sql->row(0);
        }

        private function _getWhere() {

            if (empty($this->_fields)) {
                $this->db->select('*');
            } else {
                $this->_fields = implode(",", $this->_fields);
                $this->db->select("id, {$this->_fields}");
            }
            
            $this->db->from($this->_tablename);
            $this->db->where($this->_conditions);
            $sql = $this->db->get();

            return $sql->result();
        }

    }