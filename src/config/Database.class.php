<?php
class Database
{   
  private $host = "mickaelszmfolio.mysql.db";
  private $db_name = "mickaelszmfolio";
  private $username = "mickaelszmfolio";
  private $password = "Kurzweil972";
  public $bdd; 

  /** Connexion à la base de données
  * @return string
  */
  public function dbConnection()
 {

    $this->bdd = null;    
    try
  	{
      $this->bdd = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name.";charset=UTF8", $this->username, $this->password);
  		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
    }
  	catch(PDOException $exception)
  	{
      echo "Connection error: " . $exception->getMessage();
    }

    return $this->bdd;
  }
}
?>