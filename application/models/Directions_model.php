<?php
    class Directions_model extends MY_Model {
        protected $_tablename = 'direcciones';
        // protected $belongs_to = [];

        function __construct() {
            parent::__construct();
        }

        function getDirections() {
            $this->db->select('direcciones.*, provincias.*, ciudades.*, sectores.*');
            $this->db->from($this->_tablename);
            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id', 'left');
            $this->db->join('sectores', 'direcciones.sector_id = sectores.id', 'left');
            $sql = $this->db->get();

            return $sql->result();
        }

        function getDirection($id) {
            $fields = [
                'direcciones.*', 
                'provincias.*', 
                'ciudades.*', 
                'sectores.*'
            ];
            // WATCH
            $conditions = [
                $this->_tablename.'id' => $id
            ];

            $this->db->join('provincias', 'direcciones.provincia_id = provincias.id', 'left');
            $this->db->join('ciudades', 'direcciones.ciudad_id = ciudades.id', 'left');
            $this->db->join('sectores', 'direcciones.sector_id = sectores.id', 'left');

            return $this->get(NULL, $fields, $conditions);
        }

        function saveDirection($data, $id = NULL) {
            $direction = [
                'provincia_id' => $this->_saveProvince($data['province']),
                'ciudad_id' => $this->_saveCity($data['city']),
                'sector_id' => $this->_saveSector($data['sector'])
            ];

            return $this->save($direction, $id);
        }

        private function _saveProvince($provinceId) {
            $this->db->where('id', $provinceId);
            $sql = $this->db->get('provincias');

            return $sql->row(0);
        }

        private function _saveCity($cityId) {
            $this->db->where('id', $cityId);
            $sql = $this->db->get('ciudades');

            return $sql->row(0);
        }

        private function _saveSector($sectorId) {
            $this->db->where('id', $sectorId);
            $sql = $this->db->get('sectores');

            return $sql->row(0);
        }
    }
