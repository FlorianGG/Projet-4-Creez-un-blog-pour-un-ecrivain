<?php
    include('vendor/autoload.php');

    include('controller/header.php');



    if (!empty($_GET['page'])) {
    	include('controller/article.php');
    }else{
    	include('controller/listArticles.php');
    }




?>
