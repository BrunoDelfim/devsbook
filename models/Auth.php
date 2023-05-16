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

    public function validateLogin($email, $password): bool
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
        // se não encontrar o e-mail informado no banco de dados, retorna falso
        return false;
    }
}