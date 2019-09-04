<?php
	session_start();
	include "config/Database.class.php";
	$database = new Database();
	$bdd = $database->dbConnection();

	$visibility = array_key_exists("visibility", $_POST );

	$articleId = $_GET["articleId"];

	$queryUpdate = $bdd->prepare(
		"UPDATE articles 
		SET title = ?, content = ?, author_id = ?, category_id = ?, Visibility = ?
		WHERE id = ?"
	);

	$queryUpdate->execute( [ 
		$_POST["title"],
		$_POST["content"],
		$_POST["author"],
		$_POST["category"],
		$visibility,
		$articleId
	] );
	$queryUpdate->closeCursor();

	if(isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {

		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'jpf', 'gif', 'png','webp');

		if($_FILES['picture']['size'] <= $tailleMax) {
			$extensionUpload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
			if(in_array($extensionUpload, $extensionsValides)) {
				$chemin = "../public/img/articles/".$_FILES['picture']['name'];
				$resultat = move_uploaded_file($_FILES['picture']['tmp_name'], $chemin);
				if($resultat){
					$database = new Database();
					$bdd = $database->dbConnection();
					$req = $bdd->prepare(
					'UPDATE articles 
					 SET image = ? 
					 WHERE id = ?'
					);
					$req->execute(array($_FILES['picture']['name'], $articleId));
			    	$req->closeCursor();

				header( 'Location: redirection_update.php' );
			    	

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
	header("Location: admin.php");
?>