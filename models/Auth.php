<?php

require_once 'dao/UserDaoMysql.php';
class Auth {

    // criando as variáveis para armazenar os dados recebidos
    private $pdo;
    private $base;

    // método que que recebe os valores de $pdo e $base e armazena nas variáveis privadas
    public function __construct(PDO $pdo, $base)
    {
        $this->pdo = $pdo;
        $this->base = $base;
    }

    // verifica o estado do token de acesso
    public function checkToken()
    {
        // se o token não for vazio
        if(!empty($_SESSION['token'])){
            // armazena o valor do token na variável $token
            $token = $_SESSION['token'];
            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);
            if ($user) {
                return $user;
            }
        }
        // se o token for vazio, redireciona para a página login.php
        header("Location: ".$this->base."/login.php");
        exit;
    }

    public function validateLogin($email, $password)
    {
        $userDao = new UserDaoMysql($this->pdo);
        $user = $userDao->findByEmail($email);
        if ($user) {
            if ($password_verify($password, $user->password)) {
                $token = md5(time().rand(0, 9999));
                $_SESSION['token'] = $token;
                $user->token = $token;
                $userDao->update($user);
                return true;
            }
        }
        return false;
    }

}