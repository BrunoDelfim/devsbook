<?php

require 'config.php';
require 'models/Auth.php';

/** @var object $pdo **/
/** @var object $base **/

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

if($body) {
    
} 

header("Location: ".$base);
exit;