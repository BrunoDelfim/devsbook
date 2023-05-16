<?php

    require_once 'models/User.php';

    // classe de acesso das informações do usuário utilizando mysql e implementando a interface UserDAO
    class UserDaoMysql implements UserDAO {

        // variável que irá armazenar o valor recebido na criação do objeto
        private $pdo;

        // função que irá receber o valor passado ($pdo) quando o objeto for criado
        public function __construct(PDO $driver)
        {
            // atribui o valor recebido a variável $pdo
            $this->pdo = $driver;
        }

        // método que cria e armazena as informações do objeto usuário
        private function generateUser($array)
        {
            $u = new User();
            $u->id = $array['id'] ?? 0;
            $u->email = $array['email'] ?? 0;
            $u->name = $array['name'] ?? 0;
            $u->birthdate = $array['birthdate'] ?? 0;
            $u->city = $array['city'] ?? 0;
            $u->work = $array['work'] ?? 0;
            $u->avatar = $array['avatar'] ?? 0;
            $u->cover = $array['cover'] ?? 0;
            $u->token = $array['token'] ?? 0;
        }

        // método implementado via UserDAO que verfica o token
        public function findByToken($token)
        {
            // se o token estiver preenchido
            if ($token) {
                // prepara o sql que irá consultar o banco de dados
                $sql = $this->pdo->prepare("SELECT * FROM users WHERE token = :token");
                $sql->bindValue(':token', $token);
                // executa o sql que irá consultar o banco
                $sql->execute();
                // se a consulta retornar dados
                if  ($sql->rowCount() > 0) {
                    // armazena o primeiro valor retornado na consulta e armazena em $data
                    $data = $sql->fetch(PDO::FETCH_ASSOC);
                    // cria o objeto usuário
                    $user = $this->generateUser($data);
                    // retorna o objeto criado
                    return $user;
                }
            }
            return false;
        }
    }