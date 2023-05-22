<?php

require 'config.php';
require 'models/Auth.php';

/** @var object $pdo **/
/** @var object $base **/

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();