<?php

	

	if ( !empty($_POST["nickname"]) &&
		!empty( $_POST["content"] ) &&
		!empty( $_GET["articleId"] )
	){	
		include 'config/Article.class.php';
		$nickname = $_POST["nickname"];
		$content = $_POST["content"];
		$articleId = $_GET["articleId"];

		session_start();

		$article = new Article();
		$comment = $article->addComment($nickname,$content,$articleId);

			$article->redirect("article.php?articleId=" . $articleId);
	}else{
		$article->redirect("index.php");
	}

?>