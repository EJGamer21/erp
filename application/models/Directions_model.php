<?php
    class Directions_model extends MY_Model {
        protected $_tablename = 'direcciones';
        // protected $belongs_to = [];

        function __construct() {
            parent::__construct();
        }

        function getDirections() {
            $fields = [
                'direcciones.*',
                'provincias.nombre as provinces', 
                'ciudades.nombre as cities'
            ];

            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id', 'left');

            return $this->get(NULL, $fields);
        }

        function getDirection($id) {
            $fields = [
                'direcciones.*',
                'provincias.nombre as provinces', 
                'ciudades.nombre as cities', 
            ];
            // WATCH
            $conditions = [
                $this->_primary_key => $id
            ];

            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id', 'left');

            return $this->get(NULL, $fields, $conditions);
        }

        function directionExists($direction) {
            $conditions = [
                'provincia_id' => $direction['province'],
                'ciudad_id' => $direction['city']
            ];

            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id', 'left');

            $existingDirection = $this->get(NULL, ['provincia_id, ciudad_id'], $conditions);
            var_dump($existingDirection);
            die;

            if (empty($existingDirection)) {
                return FALSE;
            } else {
                return $existingDirection;
            }
        }

        function saveDirection($data, $id = NULL) {
            $direction = [
                'provincia_id' => $this->_saveProvince($data['province'])['id'],
                'ciudad_id' => $this->_saveCity($data['city'])['id']
            ];
            return $this->save($direction, $id);
        }

        function getProvinces() {
            $sql = $this->db->get('provincias');

            return $sql->result();
        }

        function getCities() {
            $sql = $this->db->get('ciudades');

            return $sql->result();
        }

        private function _saveProvince($provinceId) {
            $this->db->where('id', $provinceId);
            $sql = $this->db->get('provincias');

            return $sql->row_array(0);
        }

        private function _saveCity($cityId) {
            $this->db->where('id', $cityId);
            $sql = $this->db->get('ciudades');

            return $sql->row_array(0);
        }
    }
