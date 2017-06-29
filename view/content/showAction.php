<?php 
	namespace view\content;


$this->title = 'Mon Blog : ' . $data['title']; 
?>

<article class="solo">
    <div class="title">
        <h1 class="titreBillet"><?= $data['title'] ?></h1>
        <time><em>Créer le : <?= $data['date'] ?></em></time>
    </div>
    <p><?= $data['content'] ?></p>
    <button><a href="index.php?controller=article&action=index">Retour à l'accueil</a></button>
</article>
