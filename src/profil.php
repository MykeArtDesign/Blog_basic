<?php 
session_start();

include "config/User.class.php";
$users = new User();

$query = $users->runQuery(
	"SELECT *
	FROM users
	WHERE id = ?
	"
);

$query->execute( [$_SESSION['id'] ] );

$user = $query->fetch();

$query->closeCursor();

include '../public/templates/profil.phtml';
 ?>