<?php 
session_start();

if( isset($_POST) && 
  !empty($_POST['username']) && 
  !empty($_POST['mail']) && 
  !empty($_POST['password']) && 
  !empty($_POST['password_verif']) && 
  $_POST['accept'] === 'on' ) 
{

  if( filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL )) 
  {

    if( $_POST['password'] === $_POST['password_verif'] ) 
    {

      require_once 'config/User.class.php';
      $users = new User;
      $users->register($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['sexe']);
      

      $users->redirect('redirection_inscription.php');
    }

  }
} 
else 
{
  echo "<script>alert(\"L'utilisateur n'a pas pu être ajouté\")</script>";
}


if(isset($_POST) && !empty($_POST['newsletter'])) 
{
  if( filter_var( $_POST['newsletter'], FILTER_VALIDATE_EMAIL )) 
  {
    require_once 'config/User.class.php';
    $users = new User();
    $subscriber = $users->runQuery('INSERT INTO newsletter (id, mail) VALUES (NULL, ?) ');
    $subscriber->execute([$_POST['newsletter']]);
    $users->redirect('redirection_inscription.php');
    
    $header  = 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $header .= 'From: ' . $_POST['newsletter'] . "\r\n";
    $to = 'contact@mickaelsorhaindo.fr';
    $subject = 'Inscription à la newsletter';
    $message = '<h1>' . $subject . '</h1>
    <h4>Email : </h4><p>' . $_POST['newsletter'] . '</p>';

    $retour = mail($to, $subject, $message, $header);
      if($retour) 
      {

        echo '<script>alert(\'Vous êtes maintenant inscrit à la newsletter.\')</script>';
        header('Refresh: 0.01; index.php');
      }
  }
}

?>