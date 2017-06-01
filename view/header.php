<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jean Forteroche</title>

	<link rel="stylesheet" href="web/css/style.css">
</head>
<ul>
	<li><a href="index.php">Accueil</a></li>
	<?php 

		foreach ($articles as $key => $value) {
			$value = [
				'id' => $articles[$key]->getId(),
				'title' => $articles[$key]->getTitle(),
			];
			echo '<li><a href="index.php?page=' . $value['id'] . '">' . $value['title'] . '</a></li>';

		}
	?>
</ul>
