<?php

    class Validation {
        
        public static function insertValidationContact($data){

            if(!is_array($data)) return false;

            $columns = ['name', 'surname', 'city', 'country', 'phone_number', 'email'];
            $insertValidation = true;
            foreach($columns as $column){
                if(!isset($data[$column])) { $insertValidation = false; break; }
            }

            
            if(!$insertValidation) return false;

            if(empty($data['name'])) return false;
            if(empty($data['surname'])) return false;
            if(empty($data['city'])) return false;
            if(empty($data['country'])) return false;
            if(empty($data['phone_number']) || strlen($data['phone_number']) < 10 ) return false;
            if(empty($data['email']) || !self::emailValidation($data['email'])) return false;

            return true;
        }

        public static function updateValidationContact($data){

            if(!is_array($data) || count($data) < 1) return false;

            if(isset(($data['name'])) && empty($data['name'])) return false;
            if(isset(($data['surname'])) && empty($data['surname'])) return false;
            if(isset(($data['city'])) && empty($data['city'])) return false;
            if(isset(($data['country'])) && empty($data['country'])) return false;
            if(isset(($data['phone_number'])) && empty($data['phone_number']) || strlen($data['phone_number']) < 10 ) return false;
            if(isset(($data['email'])) && empty($data['email']) || !self::emailValidation($data['email'])) return false;

            return true;
        }

        public static function insertValidationUser($data){

            if(!is_array($data)) return false;

            $columns = ['name', 'surname', 'email', 'username', 'password'];
            $insertValidation = true;
            foreach($columns as $column){
                if(!isset($data[$column])) { $insertValidation = false; break; }
            }

            
            if(!$insertValidation) return false;

            if(empty($data['name'])) return false;
            if(empty($data['surname'])) return false;
            if(empty($data['username']) || strlen($data['username']) < 3) return false;
            if(empty($data['password']) || strlen($data['password']) < 8) return false;
            if($data['password'] !== $data['confirm_password']) return false;
            if(empty($data['email']) || !self::emailValidation($data['email'])) return false;

            return true;
        }

        public static function emailValidation($email){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
            return true;
        }
    }