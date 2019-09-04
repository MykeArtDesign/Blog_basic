<?php  
session_start();
include 'config/Database.class.php';
header( "Refresh: 5;URL=index.php" );
include '../public/templates/redirection_contact.phtml';
?>