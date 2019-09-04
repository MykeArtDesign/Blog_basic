<?php 
session_start();
include 'config/functions.php';

if( isset($_POST) && !empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['message']) ) {

	if( filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL )) {

			$username = htmlspecialchars($_POST['username']);
			$mail = $_POST['mail'];
			$message = htmlspecialchars($_POST['message']);

			include 'config/dbconnect.php';
			$database = new Database();
			$bdd = $database->dbConnection();

			$req = $bdd->prepare('INSERT INTO contact ( username, mail, message, date_reception) VALUES ( ?, ?, ?, NOW())');
		    $req->execute(array( $username, $mail, $message ));
		    $req->closeCursor();

			header( 'Location: redirection_contact.php' );

	}
} else {
	echo "<script>alert(\"Le message n'a pas été envoyé\")</script>";
}


 ?>