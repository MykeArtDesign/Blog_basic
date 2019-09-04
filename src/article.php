<?php
	session_start();

	$articleId = $_GET['articleId'];

	include 'config/Database.class.php';
	include 'config/User.class.php';
	
	$database = new Database();
	$bdd = $database->dbConnection();

	$queryArticle = $bdd->prepare('SELECT *, articles.id AS article_id
        FROM articles
        JOIN authors ON articles.author_id = authors.id
        JOIN category ON articles.category_id = category.id
        WHERE articles.Id = ?');

      $queryArticle->execute( [ $articleId ] );
      
      $article = $queryArticle->fetch( PDO::FETCH_ASSOC );

      $queryComment = $bdd->prepare(
        "SELECT * FROM comment
        WHERE article_id = ? 
        ORDER BY id DESC"
      );
      $queryComment->execute( [ $articleId ] );

      $comments = $queryComment->fetchAll( PDO::FETCH_ASSOC );

	$userArt = new User();
	$users = $userArt->usersDatas();
	include '../public/templates/article.phtml';

	