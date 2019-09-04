<?php 
session_start();
include 'config/functions.php';
include 'config/Database.class.php';


// ----------- ADMIN UPDATE USER PROFILE -----------

if(!empty($_GET["userID"]) && $_SESSION['statut'] === 'admin') {
	$userId = $_GET["userID"];
	$database = new Database();
	$bdd = $database->dbConnection();
	$queryUser = $bdd->prepare(
		"SELECT *
		FROM users
		WHERE users.id = ?
		"
	);

	$queryUser->execute( [ $userId ] );

	$userProfil = $queryUser->fetch();

		if(isset($_FILES['avatar_profil']) && !empty($_FILES['avatar_profil']['name'])) {

			$tailleMax = 2097152;
			$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

			if($_FILES['avatar_profil']['size'] <= $tailleMax) {
				$extensionUpload = strtolower(substr(strrchr($_FILES['avatar_profil']['name'], '.'), 1));
				if(in_array($extensionUpload, $extensionsValides)) {
					$chemin = "../public/membres/avatars/".$userProfil['id'].".".$extensionUpload;
					$resultat = move_uploaded_file($_FILES['avatar_profil']['tmp_name'], $chemin);
					if($resultat){
						$req = $bdd->prepare(
						'UPDATE users 
						 SET avatar = ? 
						 WHERE id = ?'
						);
						$req->execute(array($userProfil['id'].'.'.$extensionUpload, $userProfil['id']));
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

		if( isset($_POST)) {

		if(!empty($_POST['username_profil'])) {

				$username_profil = htmlspecialchars($_POST['username_profil']);
				$database = new Database();
				$bdd = $database->dbConnection();

				$req = $bdd->prepare(
					'UPDATE users 
					 SET username = ? 
					 WHERE id = ?'
				);
			    $req->execute(array($username_profil, $userProfil['id']));
			    $req->closeCursor();

					header( 'Location: redirection_update.php' );

			}

		if(!empty($_POST['mail_profil'])) {
			if( filter_var( $_POST['mail_profil'], FILTER_VALIDATE_EMAIL )) {

				$mail_profil = $_POST['mail_profil'];
				$database = new Database();
				$bdd = $database->dbConnection();

				$req = $bdd->prepare(
					'UPDATE users 
					 SET mail = ? 
					 WHERE id = ?'
				);
			    $req->execute(array($mail_profil, $userProfil['id']));
			    $req->closeCursor();

					header( 'Location: redirection_update.php' );

			}
		}

		if(!empty($_POST['password_profil']) && !empty($_POST['password_verif_profil'])){
			if( $_POST['password_profil'] === $_POST['password_verif_profil'] ) {
					
					$password_profil = password_hash($_POST['password_profil'], PASSWORD_DEFAULT);

					
					$database = new Database();
					$bdd = $database->dbConnection();

					$req = $bdd->prepare(
					'UPDATE users 
					 SET password = ? 
					 WHERE id = ?'
				);
			    $req->execute(array($password_profil, $userProfil['id']));
			    $req->closeCursor();

					header( 'Location: redirection_update.php' );
				}

			}

			if(!empty($_POST['sexe_profil'])) {

				$sexe_profil = htmlspecialchars($_POST['sexe_profil']);
				$database = new Database();
				$bdd = $database->dbConnection();

				$req = $bdd->prepare(
					'UPDATE users 
					 SET sexe = ? 
					 WHERE id = ?'
				);
			    $req->execute(array($sexe_profil, $userProfil['id']));
			    $req->closeCursor();

					header( 'Location: redirection_update.php' );

			}

			if(!empty($_POST['statut'])) {

				$statut = htmlspecialchars($_POST['statut']);
				$database = new Database();
				$bdd = $database->dbConnection();

				$req = $bdd->prepare(
					'UPDATE users 
					 SET statut = ? 
					 WHERE id = ?'
				);
			    $req->execute(array($statut, $userProfil['id']));
			    $req->closeCursor();

					header( 'Location: redirection_update.php' );

			}
	} else {
		echo "<script>alert(\"L'utilisateur n'a pas pu être ajouté\")</script>";
	}
}

// ----------- USER UPDATE PROFIL -----------
if($_SESSION['statut'] !== 'admin') {
if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {

		$tailleMax = 2097152;
		$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

		if($_FILES['avatar']['size'] <= $tailleMax) {
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			if(in_array($extensionUpload, $extensionsValides)) {
				$chemin = "../public/membres/avatars/".$_SESSION['id'].".".$extensionUpload;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
				if($resultat){
					$database = new Database();
					$bdd = $database->dbConnection();
					$req = $bdd->prepare(
					'UPDATE users 
					 SET avatar = ? 
					 WHERE id = ?'
					);
					$req->execute(array($_SESSION['id'].'.'.$extensionUpload, $_SESSION['id']));
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



if( isset($_POST)) {

	if(!empty($_POST['username'])) {

			$username = htmlspecialchars($_POST['username']);
			$database = new Database();
			$bdd = $database->dbConnection();

			$req = $bdd->prepare(
				'UPDATE users 
				 SET username = ? 
				 WHERE id = ?'
			);
		    $req->execute(array($username, $_SESSION['id']));
		    $req->closeCursor();

				header( 'Location: redirection_update.php' );

		}

	if(!empty($_POST['mail'])) {
		if( filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL )) {

			$mail = $_POST['mail'];
			$database = new Database();
			$bdd = $database->dbConnection();

			$req = $bdd->prepare(
				'UPDATE users 
				 SET mail = ? 
				 WHERE id = ?'
			);
		    $req->execute(array($mail, $_SESSION['id']));
		    $req->closeCursor();

				header( 'Location: redirection_update.php' );

		}
	}

	if(!empty($_POST['password']) && !empty($_POST['password_verif'])){
		if( $_POST['password'] === $_POST['password_verif'] ) {
				
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

				
				$database = new Database();
				$bdd = $database->dbConnection();

				$req = $bdd->prepare(
				'UPDATE users 
				 SET password = ? 
				 WHERE id = ?'
			);
		    $req->execute(array($password, $_SESSION['id']));
		    $req->closeCursor();

				header( 'Location: redirection_update.php' );
			}

		} else {
		echo "<script>alert(\"L'utilisateur n'a pas pu être ajouté\")</script>";
	}
}
}


 ?>