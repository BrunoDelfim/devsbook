<?php

// inicia a sessão
session_start();

// define a base do sistema
$base = 'http://localhost/devsbookoo';

// define as variáveis de acesso
$db_name = 'devsbook';
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';

// acessa o banco de dados utilizando PDO
$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_password);