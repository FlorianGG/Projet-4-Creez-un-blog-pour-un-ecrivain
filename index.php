<?php

    require_once('vendor/autoload.php');

    // http://localhost/controller={controller}&action={action}
    switch($_GET['controller']){
        case 'article':
            $controller = new ArticleController();
            $action = $_GET['action'].'Action';
            echo $controller->$action();
            break;
        default:
            break;
    }
