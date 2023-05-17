<?php

require 'config.php';
require 'models/Auth.php';

/** @var object $base */
/** @var object $pdo */

// variável que irá armazenar os valores contidos nos inputs
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate');  /*mask: 00/00/0000*/
// se os inputs estiverem preenchidos
if ($name && $email && $password && $birthdate) {
    // cria o objeto Auth
    $auth = new Auth($pdo, $base);
    $birthdate = explode("/", $birthdate);
    if (count($birthdate) != 3) {
        $_SESSION['flash'] = 'Data de nascimento inválida';
        header("Location: ".$base."/signup.php");
        exit;
    }
    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
    if (strtotime($birthdate) === false) {
        $_SESSION['flash'] = 'Data de nascimento inválida';
        header("Location: ".$base."/signup.php");
        exit;
    }
    if ($auth->emailExists($email)) {

    }
}

// se $email e $password não estiverem vazios
if ($email && $password) {
    // define mensagem como:
    $_SESSION['flash'] = "Preencha todos os campos";
}
// caso o login não for validado com sucesso retorna o usuário para a página de login
header("Location: ".$base."/signup.php");
// encerra a execução
exit;