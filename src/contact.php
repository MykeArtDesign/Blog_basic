<?php 
session_start();
include 'config/Database.class.php';
include 'config/functions.php';

if( isset($_POST) && !empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['message']) ) {

	if( filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL )) {

			$username = htmlspecialchars($_POST['username']);
			$mail = $_POST['mail'];
			$message = htmlspecialchars($_POST['message']);

			
			$database = new Database();
			$bdd = $database->dbConnection();

			$req = $bdd->prepare('INSERT INTO contact ( username, mail, message, date_reception) VALUES ( ?, ?, ?, NOW())');
		    $req->execute(array( $username, $mail, $message ));

			header( 'Location: redirection_contact.php' );

	}
} elseif ( !isset($_POST) ) {
	echo "<script>alert(\"Le message n'a pas été envoyé\")</script>";
}

  if(isset($_POST)){
    if(!empty($_POST['username']) 
      && !empty($_POST['mail']))
    {
      if( filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL )) 
      {
        if(isset($_POST['message']))
        {
          $header  = 'MIME-Version: 1.0' . "\r\n";
          $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $header .= 'From: ' . $_POST['mail'] . "\r\n";
          $to = 'contact@mickaelsorhaindo.fr';
          $subject = 'Message du Blog';
          $message = '<h1>' . $subject . '</h1>
          <h4>Nom : </h4><p>' . $_POST['username'] . '</p><br>
          <h4>Email : </h4><p>' . $_POST['mail'] . '</p><br>
          <h4>Message : <h4><p>' . $_POST['message'] . '</p>';
      
          $retour = mail($to, $subject, $message, $header);
            if($retour) 
            {

              echo '<script>alert(\'Votre message a bien été envoyé.\')</script>';
              header('Refresh: 0.01; index.php');
            }
        }
      }
    }
  }
include '../public/templates/contact.phtml';
 ?>