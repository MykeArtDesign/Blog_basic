<?php
	session_start();

	include 'config/Article.class.php';
	// Vérifier si mes clés ne sont pas vides
	if(
		!empty( $_POST["title"] ) && 
		!empty( $_POST["content"] ) && 
		!empty( $_POST["author"] ) &&
		!empty( $_POST["category"] &&
		empty( $FILES['picture']) )
	){ 

		$author = $_POST["author"];
		$category = $_POST["category"];
		$imageDefault = "book.jpg";
		$title = $_POST["title"];
		$content = $_POST["content"];

		// Vérifier si mon article sera publié ou mis en attente 
		if($_POST['visibility'] === 'on') {
			$visibility = 1;
		} else {
			$visibility = 0;
		}

		$articles = new Article;

		$articles->addArticle($author, $category, $imageDefault, $title, $content);
		$articles->redirect('index.php');
		
	} else {
		echo "Votre article est mal rédigé<br>";
		echo "<a href='new_article.php'>Retour à la page de rédaction</a>";
	}
	// Code à exécuter si je charge un avatar
	if(isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
		$image = $_FILES['picture'];
		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'jpf', 'gif', 'png','webp');
 
		if($image['size'] <= $tailleMax) {
			$extensionUpload = strtolower(substr(strrchr($image['name'], '.'), 1));
			if(in_array($extensionUpload, $extensionsValides)) {
				$chemin = "img/articles/".$image['name'];
				$resultat = move_uploaded_file($image['tmp_name'], $chemin);
				if($resultat){
					$author = $_POST["author"];
					$category = $_POST["category"];
					$imageDefault = $image['name'];
					$title = $_POST["title"];
					$content = $_POST["content"];

					if($_POST['visibility'] === 'on') {
						$visibility = 1;
					} else {
						$visibility = 0;
					}

						$articles = new Article;
						$articles->addArticle($author, $category, $imageDefault, $title, $content);

						$articles->redirect('index.php');
				} else {
					$msg = "Erreur pendant l'importation de votre photo";
				}
			} else {
				$msg = "Votre photo de profil doit être au format: jpg, jpeg, gif ou png";
			}
		} else {
			$msg = 'Votre photo de profil ne doit pas dépasser 2Mo';
		}

	}
?>