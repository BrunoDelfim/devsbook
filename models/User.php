<?php

class User
{

    // declara as variáveis para receber os dados dos usuários
    public $id;
    public $email;
    public $password;
    public $name;
    public $birthdate;
    public $city;
    public $work;
    public $avatar;
    public $cover;
    public $token;
    public $following;
    public $followers;
    public $photos;
}

// interface com padronização para acessar os dados dos usuários
interface UserDAO
{
    // método para encontrar o usuário pelo token
    public function findByToken($token);
    // método para encontrar o usuário por email
    public function findByEmail($email);
    // método para definir as informações do usuário
    public function findById($id);
    public function update(User $u);
    // método para inserir as informações do usuário
    public function insert(User $u);
}