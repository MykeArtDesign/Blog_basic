<?php 
session_start();
include 'config/Database.class.php';

$database = new Database();
$bdd = $database->dbConnection();
$queryArticles = $bdd->prepare(
  "SELECT * FROM articles WHERE Visibility = 1 ORDER BY id DESC LIMIT 3" 
);

$queryArticles->execute();

$articles = $queryArticles->fetchAll( PDO::FETCH_ASSOC );
include '../public/templates/index.phtml';
?>