<?php

    require __DIR__ . '/../core/Database.php';
    class Crud {

        private $_pdo;
        private $_table;
        public function __construct()
        {
            $db = new Database;
            $this->_pdo = $db->conn();
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->_table = 'contacts';
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

            $sql = "INSERT INTO {$this->_table}({$columns}) VALUES ({$values})";
            $stmt = $this->_pdo->prepare($sql);
            return $stmt->execute($data);
        }

        public function read($user_id)
        {
            $sql = "SELECT * FROM {$this->_table} WHERE user_id = ? ORDER BY name, phone_number, city";
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute([$user_id]);
            $contacts = $stmt->fetchAll();
            return $contacts;
        }

        public function update($id, $user_id, $data)
        {
            $columns = array_keys($data);
            $set = [];
            foreach($columns as $column){
                $set[] = $column . ' = :'. $column;
            }

            $set = implode(', ', $set);
            $data['id'] = $id;
            $data['user_id'] = $user_id;

            $sql = "UPDATE {$this->_table} SET {$set} WHERE id = :id AND user_id = :user_id";
            $stmt = $this->_pdo->prepare($sql);
            return $stmt->execute($data);
        }

        public function delete($id, $user_id)
        {
            $conditions = [
                'id' => $id,
                'user_id' => $user_id
            ];

            $sql = "DELETE FROM {$this->_table} WHERE id = :id AND user_id = :user_id";
            $stmt = $this->_pdo->prepare($sql);
            return $stmt->execute($conditions);
        }

    }