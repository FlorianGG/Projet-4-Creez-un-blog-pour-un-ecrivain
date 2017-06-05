<?php 

	$id = (int)$_GET['id'];	

	$managerArticle = new managerArticle;

	$article = $managerArticle->read($id);

	if (!is_null($article)){
		$titre = $article->getTitle();
		$content = $article->getContent();
		$dateArticle = $article->getDateArticle();

		include('view/article.php');
	}else{
		echo "<h2>Article introuvable</h2>";
	}


	

?>
