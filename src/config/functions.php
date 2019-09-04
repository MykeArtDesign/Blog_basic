<?php

/** Création d'un onglet menu
    * @return string
    */
function nav_item (string $lien, string $titre, string $linkClass = '',$idOrange = ''): string 
{
  $classe = 'nav-item';
  if ($_SERVER['SCRIPT_NAME'] === "/Portfolio/BlogHtdocs/src/".$lien) {
    $idOrange = 'id="active"';
  }

  return <<<HTML
  <li >
  <a $idOrange $linkClass href="$lien" aria-label="$titre">$titre</a>
  </li>
  HTML;
}

/** Menu invité
    * @return string
    */
function nav_menu (string $linkClass = ''): string {
  return 
  nav_item('index.php', 'Accueil', 'class="link"') .
  nav_item('inscription.php', 'S\'inscrire', 'class="link"') .
  nav_item('connexion.php', 'Connexion', 'class="link"') .
  nav_item('archives.php', 'Archives', 'class="link"') .
  nav_item('contact.php', 'Contact', 'class="link"');

}

/** Menu membre
    * @return string
    */
function connect_menu (string $linkClass = ''): string {
  return 
  nav_item('index.php', 'Accueil', 'class="link"') .
  nav_item('profil.php', 'Mon profil') .
  nav_item('disconnect.php', 'Déconnexion', 'class="link"') .
  nav_item('archives.php', 'Archives', 'class="link"') .
  nav_item('contact.php', 'Contact', 'class="link"');

}

/** Menu Admin
    * @return string
    */
function admin_menu (string $linkClass = ''): string {
  return 
  nav_item('index.php', 'Accueil', 'class="link"') .
  nav_item('espace_membre.php', 'Espace Membres', 'class="link"') .
  nav_item('admin.php', 'Gestion des Articles', 'class="link"') .
  nav_item('new_article.php', 'Nouvel Article', 'class="link"') .
  nav_item('disconnect.php', 'Déconnexion', 'class="link"') .
  nav_item('archives.php', 'Archives', 'class="link"') .
  nav_item('contact.php', 'Contact', 'class="link"');

}


?>