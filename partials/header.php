<?php

/** @var object $base */

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base."/"?>assets/css/style.css" />
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="<?=$base?>"><img src="<?=$base."/"?>assets/images/devsbook_logo.png"  alt="Logo-Devsbook"/></a>
        </div>
        <div class="head-side">
            <div class="head-side-left">
                <div class="search-area">
                    <form method="GET">
                        <label>
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </label>
                    </form>
                </div>
            </div>
            <div class="head-side-right">
                <a href="<?=$base."/"?>perfil.php" class="user-area">
                    <div class="user-area-text">Bruno</div>
                    <div class="user-area-icon">
                        <img src="<?=$base."/"?>media/avatars/avatar.jpg"  alt="avatar"/>
                    </div>
                </a>
                <a href="<?=$base."/"?>logout.php" class="user-logout">
                    <img src="<?=$base."/"?>assets/images/power_white.png"  alt="logout-icon"/>
                </a>
            </div>
        </div>
    </div>
</header>
<section class="container main">