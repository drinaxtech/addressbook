<?php

    require_once __DIR__ . '/../core/Database.php';

    class Auth {

        private $_pdo;
        private $_table;
        public function __construct()
        {
            $db = new Database;
            $this->_pdo = $db->conn();
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->_table = 'users';
        }

        public function create($data)
        {
            $columns = array_keys($data);
            $values = [];
            foreach($columns as $column){
                $values[] = ':'. $column;
            }

            $columns = implode(', ', $columns);
            $values = implode(', ', $values);

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO {$this->_table}({$columns}) VALUES ({$values})";
            $stmt = $this->_pdo->prepare($sql);
            return $stmt->execute($data);
        }

        public function login($username, $password)
        {
            $param = (!filter_var($username, FILTER_VALIDATE_EMAIL)) ? 'username' : 'email';
    
            $sql = "SELECT * FROM {$this->_table} WHERE {$param} = ?";
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute([$username]);
            $userCount = $stmt->rowCount();
            $user = $stmt->fetch();

            if($userCount < 1){
                return false;
            }

            if (password_verify($password, $user['password'])) {
                return $user;
            }

            return false;

        }

        public function checkIfExists($param, $value)
        {
            $sql = "SELECT * FROM {$this->_table} WHERE {$param} = ?";
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute([$value]);
            $userCount = $stmt->rowCount();
            $user = $stmt->fetch();

            if($userCount < 1){
                return false;
            }

            return true;
        }


    }