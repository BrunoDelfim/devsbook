<?php

    session_start();

    $base = 'http://localhost/devsbook';

    $db_name = 'devsbookoo';
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
   
    $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_password);