<?php 
	session_start();

	include 'config/Database.class.php';
	$database = new Database();
	$bdd = $database->dbConnection();

	$queryUsers = $bdd->prepare(
		"
		SELECT *
		FROM users
		"
	);

	$queryUsers->execute();

	$users = $queryUsers->fetchAll( PDO::FETCH_ASSOC );
	$queryUsers->closeCursor();

	include '../public/templates/espace_membre.phtml';
 ?>