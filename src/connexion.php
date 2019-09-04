<?php 

	include 'config/User.class.php';
	$connect = new User;

	if( isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
			
		$connect->doLogin($_POST['login'], $_POST['password']);
		$connect->is_loggedin();
		$connect->redirect('index.php');
	} 

	require '../public/templates/connexion.phtml';
?>