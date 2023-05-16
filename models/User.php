<?php

    class User {

        // declara as variáveis para receber os dados dos usuários
        public $id;
        public $email;
        public $password;
        public $name ;
        public $birthdate;
        public $city;
        public $work;
        public $avatar;
        public $cover;
        public $token;
    }

    // interface com padronização para acessar os dados dos usuários
    interface UserDAO {
        // método para encontrar o usuário pelo token
        public function findByToken($token);
    }