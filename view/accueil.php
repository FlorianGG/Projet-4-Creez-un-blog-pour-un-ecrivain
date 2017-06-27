<?php 
namespace view;


$this->title = 'Mon Blog : Accueil';
$count = count($data)-1;
?>

<div class="articles">
	<?php for ($i=$count;  $i >= $count - 3 ; $i--) { 
		$overview = substr($data[$key]['content'],0, 50) . '...';	
	?>
	<article class="multi">
	    <div class="title">
	    	<h1 class="articleTitle"><?= $data[$i]['title'] ?></h1>
	    	<time><em>Créer le : <?= $data[$i]['date'] ?></em></time>
	    </div>
	    <p><?= $overview ?></p>
	    <button><a href="index.php?controller=article&action=show&id=<?php echo $data[$i]['id']; ?>">Lire l'article</a></button>
	</article>
	<?php } ?>
</div>
