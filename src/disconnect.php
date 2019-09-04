<?php 
session_start();


$_SESSION = array();
include 'config/User.class.php';
$users = new User();
$users->doLogout();


setcookie('login', '');
setcookie('password_hache', '');

$users->redirect('index.php');