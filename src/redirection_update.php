<?php  
session_start();
if(!empty($_SESSION) && $_SESSION['connected']) { 
	if( $_SESSION['statut'] === 'admin'){
		header( "Refresh: 5;URL=espace_membre.php" );	
	} else{
		header( "Refresh: 5;URL=index.php" );	
	}
}

include 'config/Database.class.php';
include '../public/templates/redirection_update.phtml';

?>