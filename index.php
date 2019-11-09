<?php
require_once 'core/init.php';

$user = DB::getInstance()->update('users', 6, array(
    'password' => 'newpassword', 
    'name' => 'Dale Garrett'
));
?>