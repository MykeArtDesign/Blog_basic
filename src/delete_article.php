<?php
	session_start();
	include 'config/Database.class.php';
	$database = new Database();
	$bdd = $database->dbConnection();

	$articleId = $_GET["articleId"];

	$queryHide = $bdd->prepare(
		"UPDATE articles SET Visibility = 0 WHERE id = ?"
	);

	$queryHide->execute( [ $articleId ] );
	$queryHide->closeCursor();

	header("Location: admin.php");
?>