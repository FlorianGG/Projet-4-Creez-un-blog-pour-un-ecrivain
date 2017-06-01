<?php 
	$listArticles = new managerArticle;

	$articles = $listArticles->readAll();

	include('view/header.php');
?>



