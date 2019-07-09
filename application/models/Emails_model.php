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

        function save($email, $id = NULL) {
            return $this->save($email, $id);
        }
    }
