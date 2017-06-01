<?php
    include('vendor/autoload.php');

    include('controller/header.php');



    if ($_GET['action'] === 'index' || $_GET['action'] !== 'index' || empty($_GET['action'])) {
    	include('controller/indexController.php');
    }elseif ($_GET['action'] === 'show') {
    	include('controller/article.php');
    }

?>
