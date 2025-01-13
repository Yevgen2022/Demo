<?php

use Core\Authenticator;

//$_SESSION = [];
//
//session_destroy();
//
//$params = session_get_cookie_params();
//setcookie('PHPSESSID', '',time()- 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);


$authenticator = new Authenticator();
$authenticator->logout();

header('location: /');
exit();