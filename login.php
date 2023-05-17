<?php

require 'config.php';

/** @var object $base **/

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base."/";?>assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href="<?=$base;?>"><img src="<?=$base."/";?>assets/images/devsbook_logo.png" alt="logo"/></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=$base."/";?>login_action.php">
            <label>
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />
            </label>
            <label>
                <input placeholder="Digite sua senha" class="input" type="password" name="password" />
                <?php
                    // Se $_SESSION['flash'] não estiver vazia
                    if (!empty($_SESSION['flash'])) {
                        // exibe mensagem de erro
                        echo "<p class="."login-invalido" . ">".$_SESSION['flash']."</p>";
                        // limpa $_SESSION['flash']
                        unset($_SESSION['flash']);
                    }
                ?>
            </label>
            <label>
                <input class="button" type="submit" value="Acessar o sistema" />
            </label>
            <a href="<?=$base."/";?>signup.php">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>
</body>
</html>