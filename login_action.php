<?php

require 'config.php';
require 'models/Auth.php';

/** @var object $base */
/** @var object $pdo */

// variável que irá armazenar os valores contidos nos inputs
$email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
// se os inputs tiverem preenchidos
if ($email && $password) {
    // cria o objeto Auth
    $auth = new Auth($pdo, $base);
    // se o login for validado com sucesso
    if ($auth->validateLogin($email, $password)) {
        // encaminha o usuário para o feed
        header("Location: " . $base);
        // encerra a execução
        exit;
    }
}

// se $email e $password estiverem vazios
if (!$email || !$password) {
    // define mensagem como:
    $_SESSION['flash'] = 'E-mail e/ou senha não preenchidos(as)';
}
// caso o login não for validado com sucesso retorna o usuário para a página de login
header("Location: " . $base . "/login.php");
// encerra a execução
exit;