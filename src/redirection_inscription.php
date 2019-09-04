<?php  
session_start();
header( "Refresh: 5;URL=index.php" );
include 'config/Database.class.php';
include '../public/templates/redirection_inscription.phtml';

?>