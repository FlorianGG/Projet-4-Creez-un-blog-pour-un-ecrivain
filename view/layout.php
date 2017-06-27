<?php 
	namespace view;
 ?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="web/css/style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="content">
			<?php require('nav.php'); ?>
            <div id="specificContent">
                <?= $content ?>
            </div>
            <?php require('footer.php'); ?>
        </div> 
    </body>
</html>
