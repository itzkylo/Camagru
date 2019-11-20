<?php

require_once '/goinfre/kjohnsto/Desktop/MAMP/apache2/htdocs/Camagru/config/database.php';
// require_once '../config/database.php';

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => $host,
        'username' => $username,
        'password' => $password,
        'db' => $db_name
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expire' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php'; 
});

require_once 'functions/sanitize.php';