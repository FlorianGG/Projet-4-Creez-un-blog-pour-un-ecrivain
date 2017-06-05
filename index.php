<?php
    require_once('vendor/autoload.php');

    //include('controller/header.php');


     // http://localhost/controller={controller}&action={action}

    switch ($_GET['controller']) {

    	case 'article':
    		$controller = new ArticleController();
    		$action = $_GET['action'] . 'Action';
    		echo $controller->$action();
    		break;  	
    	default:
    		$controller = new ArticleController();
    		echo $controller->indexAction();
    		break;
    }


    // if ($_GET['action'] === 'index' || ($_GET['action'] !== 'index' && $_GET['action'] !== 'show') || empty($_GET['action'])) {
    // 	include('controller/indexController.php');
    // }elseif ($_GET['action'] === 'show') {
    // 	include('controller/article.php');
    // }
