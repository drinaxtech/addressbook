<?php

    require_once __DIR__ . '/config.php';

    class Database {

        private $_instance = null;
        private $_pdo;
        public function __construct(){

            try {
                $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            } catch(\PDOException $e){
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        public function conn(){
            if($this->_instance === null){
                $this->_instance = $this->_pdo;
            }

            return $this->_instance;
        }

    }