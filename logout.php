<?php

require 'config.php';

/** @var object $base **/

unset($_SESSION['token']);
header("Location: ".$base);
exit;