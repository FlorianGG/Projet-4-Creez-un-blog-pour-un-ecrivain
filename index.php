<?php
    include('vendor/autoload.php');

    include('controller/header.php');



    if ($_GET['action'] === 'index' || ($_GET['action'] !== 'index' && $_GET['action'] !== 'show') || empty($_GET['action'])) {
    	include('controller/indexController.php');
    }elseif ($_GET['action'] === 'show') {
    	include('controller/article.php');
    }

?>
