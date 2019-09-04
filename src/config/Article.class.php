<?php

require_once('Database.class.php');

class Article
{ 
  /**
   * Variable qui contiendra la connexion à ma bdd
   * @var string
   */
  private $bdd;
  /** Constructeur de ma classe article
  * bdd
  */
  public function __construct()
  {
    $database = new Database();
    $db = $database->dbConnection();
    $this->bdd = $db;
  }
  
  /** Prépare une requête sql
   * @param  string $sql [ma requête sql]
   * @return [SQL]      [ma requête sql]
   */
  public function runQuery(?string $sql):string
  {
    $req = $this->bdd->prepare($sql);
    return $req;
  }
  
   /**
    * [addArticle Ajout d'article à ma bdd]
    * @param string $author_id   [ID de l'Auteur de l'article]
    * @param string $category_id [ID de la catégorie de l'article]
    * @param string $image       [Image lié à l'article]
    * @param string $title       [Titre de mon article]
    * @param string $content     [Contenu de mon article]
    * @param string $Visibility  [Article visible ou pas par les visiteurs]
    */
   public function addArticle(?string $author_id,?string $category_id,?string $image= '',?string $title,?string $content ,?string $Visibility = '1') :object
   {
    try
    {
     
      $req = $this->bdd->prepare("
        INSERT INTO articles(id, author_id, category_id, image, title, publishDate, content, Visibility) 
        VALUES(NULL,:author_id, :category_id, :image, :title, NOW(), :content, :Visibility)
        ");
      
      $req->bindparam(":author_id", $author_id);
      $req->bindparam(":category_id", $category_id);
      $req->bindparam(":image", $image);
      $req->bindparam(":title", $title);
      $req->bindparam(":content", $content);
      $req->bindparam(":Visibility", $Visibility);

      $req->execute();
      return $req;  
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }       
  }

  /** Ajout de commentaires dans la bdd
  * @return array
  */
  public function addComment($nickname,$content,$articleId, $sexe = '', $avatar = '') :object
  {
    try
    {
      if(!empty($_SESSION) & $_SESSION['connected']){
        $avatar = $_SESSION['avatar'];
        $sexe = $_SESSION['sexe'];
      }
      $req = $this->bdd->prepare("
        INSERT INTO comment( nickname, content, publishDate,article_id, sexe, avatar) 
        VALUES(:nickname, :content, NOW(), :articleId, :sexe, :avatar)
        ");
      
      $req->bindparam(":nickname", $nickname);
      $req->bindparam(":content", $content);
      $req->bindparam(":articleId", $articleId);
      $req->bindparam(":sexe", $sexe);
      $req->bindparam(":avatar", $avatar);

      $req->execute();
      return $req;  
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }       
  }
  
  /** Redirection d'URL
  * @return string
  */
  public function redirect($url) :string
  {
    header("Location: $url");
  }
  /** Redirection d'URL avec un temps de latence
  * @return string
  */
  public function refresh($url):string
  {
    header("Refresh: $time, $url");
  }
}
?>„