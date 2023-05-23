<?php

require 'config.php';
require 'models/Auth.php';

/** @var object $base */
/** @var object $pdo */

// variável que irá armazenar os valores contidos nos inputs
$name      = filter_input(INPUT_POST, 'name');
$email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password  = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate'); /*mask: 00/00/0000*/
// se os inputs estiverem preenchidos
if ($name && $email && $password && $birthdate) {
    // cria o objeto Auth
    $auth = new Auth($pdo, $base);
    // cria array com as informações de birthdate separando por "/"
    $birthdate = explode("/", $birthdate);
    // caso a array não tenha três elementos
    if (count($birthdate) != 3) {
        // define mensagem como:
        $_SESSION['flash'] = 'Data de nascimento inválida';
        // retorna o usuário para a página de login
        header("Location: " . $base . "/signup.php");
        // finaliza o processo
        exit;
    }
    // transforma $birthdate no tipo de data internacional
    $birthdate = $birthdate[2] . '-' . $birthdate[1] . '-' . $birthdate[0];
    // se data for inválida ou for menor que 01/01/1930
    if (strtotime($birthdate) === false || strtotime($birthdate) <= 1930 - 01 - 01) {
        // define mensagem como:
        $_SESSION['flash'] = 'Data de nascimento inválida';
        // retorna o usuário para a página de login
        header("Location: " . $base . "/signup.php");
        // finaliza o processo
        exit;
    }
    // se o e-mail informado não estiver sendo utilizado por outro usuário
    if ($auth->emailExists($email) === false) {
        // utiliza o método da classe Auth para registrar o usuário com as informações passadas pelo formulário
        $auth->registerUser($name, $email, $password, $birthdate);
        // redireciona o usuário para a página inicial do sistema
        header("Location: " . $base);
        // finaliza o processo
        exit;
    } else {
        // define mensagem como:
        $_SESSION['flash'] = "E-mail já cadastrado";
    }
}
// se $email, $password, $email e $birthdate estiverem vazios
if (!$name || !$email || !$password || !$birthdate) {
    // define mensagem como:
    $_SESSION['flash'] = 'Preencha todos os campos!';
}

// caso o login não for validado com sucesso retorna o usuário para a página de login
header("Location: " . $base . "/signup.php");
// encerra a execução
exit;