<?php
	session_start();
	include 'config/Database.class.php';
	
	$database = new Database();
	$bdd = $database->dbConnection();
	$queryArticles = $bdd->prepare(
    	"SELECT * FROM articles ORDER BY id DESC" 
    );

    $queryArticles->execute();

    $articles = $queryArticles->fetchAll( PDO::FETCH_ASSOC );
    include '../public/templates/admin.phtml';
?>