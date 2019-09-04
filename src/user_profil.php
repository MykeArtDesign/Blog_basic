<?php
	session_start();
	include "config/Database.class.php";
	$database = new Database();
	$bdd = $database->dbConnection();

	$userId = $_GET["userID"];


	$queryUser = $bdd->prepare(
		"SELECT *
		FROM users
		WHERE users.id = ?
		"
	);

	$queryStatut = $bdd->prepare(
		"
		SELECT *
		FROM statut
		"
	);

	$queryUser->execute( [ $userId ] );
	$queryStatut->execute();

	$userProfil = $queryUser->fetch();
	$statut = $queryStatut->fetchAll( PDO::FETCH_ASSOC );
	include '../public/templates/user_profil.phtml';
?>