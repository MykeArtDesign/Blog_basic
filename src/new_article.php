<?php
	session_start();
	include "config/Database.class.php";
	$database = new Database();
	$bdd = $database->dbConnection();

	$queryCategory = $bdd->prepare(
		"SELECT * FROM category"
	);

	$queryAuthor = $bdd->prepare(
		"SELECT * FROM authors"
	);

	$queryCategory->execute();
	$queryAuthor->execute();

	$categories = $queryCategory->fetchAll( PDO::FETCH_ASSOC );
	$authors = $queryAuthor->fetchAll( PDO::FETCH_ASSOC );
	$queryCategory->closeCursor();
	$queryAuthor->closeCursor();
	include "../public/templates/new_article.phtml";
?>