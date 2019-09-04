<?php

require_once('Database.class.php');

class User
{ 
  
  private $bdd;
  
  /** Connexion dans la bdd
  * @return string
  */
  public function __construct()
  {
    $database = new Database();
    $db = $database->dbConnection();
    $this->bdd = $db;
  }
  
  /** créer une requête
  * @return string
  */
  public function runQuery($sql)
  {
    $req = $this->bdd->prepare($sql);
    return $req;
  }
  
  /** Inscription dans la bdd
  * @return string
  */
  public function register($username,$mail,$password,$sexe,$avatar= '',$statut = 'membre')
  {

    if(empty($avatar)){
      if($sexe === 'homme') {
        $avatar = 'homme.png';
      } elseif ($sexe === 'femme') {
        $avatar = 'femme.png';
      } else {
        $avatar = '';
      }
    }
    try
    {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);
      
      $req = $this->bdd->prepare("
        INSERT INTO users(id, username, mail, password, sexe, date_inscription, avatar, statut) 
        VALUES(NULL,:username, :mail, :password, :sexe, NOW(), :avatar, :statut)
        ");
      
      $req->bindparam(":username", $username);
      $req->bindparam(":mail", $mail);
      $req->bindparam(":password", $hashPassword);
      $req->bindparam(":sexe", $sexe);
      $req->bindparam(":avatar", $avatar);
      $req->bindparam(":statut", $statut);

      $req->execute();  
      $req->closeCursor();
      return $req;  
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }       
  }
  
  
  /** Connexion en allant vérifier dans la bdd
  * @return string
  */
  public function doLogin($login,$password)
  {
    try
    {
      $req = $this->bdd->prepare("SELECT * FROM users WHERE username=:username OR mail=:mail ");
      $req->execute(array(':username'=>$login, ':mail'=>$login, ));
      $user=$req->fetch(PDO::FETCH_ASSOC);
      if($req->rowCount() == 1)
      {
        if(password_verify($password, $user['password']))
        {
          
          session_start();
          $_SESSION['connected'] = true;
          $_SESSION['id'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['mail'] = $user['mail'];
          $_SESSION['sexe'] = $user['sexe'];
          $_SESSION['avatar'] = $user['avatar'];
          $_SESSION['statut'] = $user['statut'];
          return true;
        }
        else
        {
          return false;
          header('Location: connexion.php');
          echo 'Mauvais identifiant ou mot de passe';
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
  
  /** Vérification de la clé dans $_SESSION
  * @return bool
  */
  public function is_loggedin()
  {
    if(isset($_SESSION['username']))
    {
      return true;
    }
  }

  /** Récupération des données Users dans la bdd
  * @return string
  */
  public function usersDatas() {      
    $queryUsers = $this->bdd->prepare(
      "SELECT *
      FROM users"
    );
    $queryUsers->execute();

    $users = $queryUsers->fetchAll( PDO::FETCH_ASSOC );
    return $users;
  }
  
  /** Redirection d'URL
  * @return string
  */
  public function redirect($url)
  {
    header("Location: $url");
  }

  /** Redirection d'URL avec un temps de latence
  * @return string
  */
  public function refresh($url)
  {
    header("Refresh: $time, $url");
  }
  
  /** Déconnexion de la Session
  * @return string
  */
  public function doLogout()
  {
    session_destroy();
    unset($_SESSION['username']);
    return true;
  }
}
?>