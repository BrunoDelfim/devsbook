<?php

require_once 'dao/UserDaoMysql.php';
class Auth {

    // criando as variáveis para armazenar os dados recebidos
    private $pdo;
    private $base;
    private $dao;

    // método que que recebe os valores de $pdo e $base e armazena nas variáveis privadas
    public function __construct(PDO $pdo, $base)
    {
        $this->pdo = $pdo;
        $this->base = $base;
        $this->dao = new UserDaoMysql($this->pdo);
    }

    // verifica o estado do token de acesso
    public function checkToken()
    {
        // se o token não for vazio
        if(!empty($_SESSION['token'])){
            // armazena o valor do token na variável $token
            $token = $_SESSION['token'];
            $user = $this->dao->findByToken($token);
            if ($user) {
                return $user;
            }
            return false;
        }
        // se o token for vazio, redireciona para a página login.php
        header("Location: ".$this->base."/login.php");
        exit;
    }

    public function validateLogin($email, $password):bool
    {
        // executa o método para encontrar o usuário pelo email informado
        $user = $this->dao->findByEmail($email);
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
                $this->dao->update($user);
                // retorna verdadeiro
                return true;
            }
        }
        $_SESSION['flash'] = 'E-mail e/ou senha incorretos(as)';
        // se não encontrar o e-mail informado no banco de dados, retorna falso
        return false;
    }

    // método para verificar se o e-mail informado já existe
    public function emailExists($email)
    {
        // retorna se o e-mai foi encontrado, fazendo o uso do método procurar por e-mail existente na classe UserDaoMysql
        return $this->dao->findByEmail($email);
    }

    // método que registra novo usuário
    public function registerUser($name, $email, $password, $birthdate)
    {
        // cria o objeto usuário
        $newUser = new User();
        // define o hash que será gerado a partir da senha informada
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // define o token da sessão usando md5
        $token = md5(time().rand(0, 9999));
        // define as informações do objeto usário criado
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->birthdate = $birthdate;
        $newUser->token = $token;
        // passa o objeto usuário para o método insert da classe UserDaoMysql
        $this->dao->insert($newUser);
        // define o token da sessão
        $_SESSION['token'] = $token;
    }
}