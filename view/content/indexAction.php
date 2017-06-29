<?php 
namespace view\content;


$this->title = 'Mon Blog : Liste des artiles'; 
?>

<div class="articles">
	<?php foreach ($data as $key => $value){ 
		$overview = substr($data[$key]['content'],0, 50) . '...';
	?>
		<article class="multi">
		    <div class="title">
		    	<h1 class="titreBillet"><?= $data[$key]['title'] ?></h1>
		    	<time><em>Créer le : <?= $data[$key]['date'] ?></em></time>
		    </div>
		    <p><?= $overview ?></p>
		    <button><a href="index.php?controller=article&action=show&id=<?php echo $data[$key]['id']; ?>">Lire l'article</a></button>
		</article>
	<?php } ?>
</div>



