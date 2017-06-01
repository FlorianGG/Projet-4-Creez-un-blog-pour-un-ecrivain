<?php 
	
	    $managerArticle = new managerArticle;

		$articles =	$managerArticle->readAll();
		

		foreach ($articles as $key => $value) {
			$value = [
				'title' => $articles[$key]->getTitle(),
				'content' => $articles[$key]->getContent(),
				'dateArticle' => $articles[$key]->getDateArticle(),
			];
			echo '<h2>' . $value['title'] . '</h2>';
			echo '<p>' . $value['content'] . '</p>';
			echo '<p><em> Crée le : ' . $value['dateArticle'] . '</em></p>';

		}





?>
