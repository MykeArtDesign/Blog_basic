<?php
	session_start();
	include 'config/Database.class.php';
	$database = new Database();
	$bdd = $database->dbConnection();

	$articleId = $_GET["articleId"];

	$queryArticle = $bdd->prepare(
		"SELECT * FROM articles WHERE id = ?"
	);

	$queryArticle->execute( [ $articleId ] );

	/******* Infos sur auteurs et catégories ********/
	$queryCategory = $bdd->prepare(
		"SELECT * FROM category"
	);

	$queryAuthor = $bdd->prepare(
		"SELECT * FROM authors"
	);

	$queryCategory->execute();
	$queryAuthor->execute();
	/***************/

	$categories = $queryCategory->fetchAll( PDO::FETCH_ASSOC );
	$authors = $queryAuthor->fetchAll( PDO::FETCH_ASSOC );

	$article = $queryArticle->fetch( PDO::FETCH_ASSOC );
	$queryCategory->closeCursor();
	$queryAuthor->closeCursor();
	$queryArticle->closeCursor();


	include "../public/templates/edit.phtml";
?>