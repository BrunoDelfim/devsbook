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
            return false;
        }
        // se o token for vazio, redireciona para a página login.php
        header("Location: ".$this->base."/login.php");
        exit;
    }

    public function validateLogin($email, $password)
    {
        // cria objeto userDaoMysql
        $userDao = new UserDaoMysql($this->pdo);
        // executa o método para encontrar o usuário pelo email informado
        $user = $userDao->findByEmail($email);
        // se o email for válido e existente no banco de dados
        if ($user) {
            // verifica se senha está correta
            if (password_verify($password, $user->password)) {
                // gera o token
                $token = md5(time().rand(0, 9999));
                // armazena o token na sessão 'token'
                $_SESSION['token'] = $token;
                // define o token do usuário no objeto usuário
                $user->token = $token;
                // atualiza as informações do usuário logado
                $userDao->update($user);
                // retorna verdadeiro
                return true;
            }
        }
        $_SESSION['flash'] = 'E-mail e/ou senha incorretos(as)';
        // se não encontrar o e-mail informado no banco de dados, retorna falso
        return false;
    }

    public function emailExists($email)
    {
        $userDao = new UserDaoMysql($this->pdo);
        return $userDao->findByEmail($email);
    }

    public function registerUser($name, $email, $password, $birthdate)
    {
        $userDao = new UserDaoMysql($this->pdo);
        $newUser = new User();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0, 9999));
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->birthdate = $birthdate;
        $newUser->token = $token;
        $userDao->insert($newUser);
        $_SESSION['token'] = $token;
    }
}