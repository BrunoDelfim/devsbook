<?php

require_once 'models/User.php';

// classe de acesso das informações do usuário utilizando mysql e implementando a interface UserDAO
class UserDaoMysql implements UserDAO
{

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
        $u            = new User();
        $u->id        = $array['id'] ?? 0;
        $u->email     = $array['email'] ?? 0;
        $u->name      = $array['name'] ?? 0;
        $u->password  = $array['password'] ?? 0;
        $u->birthdate = $array['birthdate'] ?? 0;
        $u->city      = $array['city'] ?? 0;
        $u->work      = $array['work'] ?? 0;
        $u->avatar    = $array['avatar'] ?? 0;
        $u->cover     = $array['cover'] ?? 0;
        $u->token     = $array['token'] ?? 0;
        return $u;
    }

    // método implementado via UserDAO que verifica o token
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
            if ($sql->rowCount() > 0) {
                // armazena o primeiro valor retornado na consulta e armazena em $data
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                // cria o objeto usuário
                $user = $this->generateUser($data);
                // retorna o objeto criado
                return $user;
            }
        }
        // caso o token informado não seja encontrado retorna falso
        return false;
    }

    public function findByEmail($email)
    {
        // se o token estiver preenchido
        if ($email) {
            // prepara o sql que irá consultar o banco de dados
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindValue(':email', $email);
            // executa o sql que irá consultar o banco
            $sql->execute();
            // se a consulta retornar dados
            if ($sql->rowCount() > 0) {
                // armazena o primeiro valor retornado na consulta e armazena em $data
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                // cria o objeto usuário
                $user = $this->generateUser($data);
                // retorna o objeto criado
                return $user;
            }
        }
        // caso não o e-mail informado não seja encontrado retorna falso
        return false;
    }

    public function update(User $u)
    {
        // prepara a atualização do usuário no banco de dados conforme o token
        $sql = $this->pdo->prepare("UPDATE users SET
            email = :email,
            password = :password,
            name = :name,
            birthdate = :birthdate,
            city = :city,
            work = :work,
            avatar = :avatar,
            cover = :cover,
            token = :token
            WHERE id = :id");
        // insere os valores reais no sql
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':city', $u->city);
        $sql->bindValue(':work', $u->work);
        $sql->bindValue(':avatar', $u->avatar);
        $sql->bindValue(':cover', $u->cover);
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':id', $u->id);
        // executa a consulta sql
        $sql->execute();
        // retorna verdadeiro
        return true;
    }

    // método que insere novos usuários no banco de dados
    public function insert(User $u)
    {
        // prepara a inserção sql
        $sql = $this->pdo->prepare("INSERT INTO users (
            email, password, name, birthdate, token, city, work, avatar, cover   
    ) VALUES (
            :email, :password, :name, :birthdate, :token,
              default, default, 'default.jpg', 'cover.jpg'
    )");
        // insere os valores reais no sql
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':token', $u->token);
        // executa o sql
        $sql->execute();
        // retorna verdadeiro
        return true;
    }
}