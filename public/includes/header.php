<?php require_once 'config/functions.php';
$bdd = new Database();
$req = $bdd->dbConnection();

$query = $req->prepare(
  "SELECT *
  FROM users
  WHERE id = ?
  "
);
if(isset($_SESSION) && !empty($_SESSION['id']))
{
  $query->execute( [$_SESSION['id'] ] );

  $user = $query->fetch();
}

?>
<header class="flex space-between">
    <a href="../../../index.html">Retour</a>
    <a href="index.php"><img src="../public/img/logo.png" alt="logo" class="logo"></a>
    
    <nav>
      <i class="fas fa-bars menu-mobile"></i>
      <ul class="displayMenu flex column hide">
        <?php 
        if ( !empty($_SESSION) && $_SESSION['connected'] && $_SESSION['statut'] !== 'admin' ) 
        {
          echo connect_menu();
        } 
        else if( !empty($_SESSION) && $_SESSION['connected'] && $_SESSION['statut'] === 'admin') 
        {
          echo admin_menu();
        } 
        else 
        {
          echo nav_menu();
        }

        ?>
        <li><a href="../../../index.html" class="link">Portfolio</a></li>
    <?php 
    if(!empty($user['avatar'])): 
      ?> 
      <div class="avatar">
        <div style=" 
        background-image: url( ../public/membres/avatars/<?= $user['avatar'] ?> );
        background-size: cover; 
        background-position: center;
        border: 3px solid #535353;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin-bottom: 8px;         
        ">
        </div>
      </div>
    <?php endif; ?> 
      </ul>
    </nav>
    

</header>