<?php
    require_once('vendor/autoload.php');

     // http://localhost/controller={controller}&action={action}

    if (!empty($_GET['controller'])) {
        //on verifie que l'url est correcte par rapport à toutes les fonction
        switch ($_GET['controller']) {

                case 'article'://on verifie que le controller appellé est bien article sinon on affiche la liste des articles par défaut
                    $controller = new ArticleController();
                    if (isset($_GET['action'])) {//on verifie que le paramètre de l'url action existe 
                        $action = $_GET['action'] . 'Action';
                        if (method_exists($controller, $action)) { //on verifie que la méthode issue de la valeur d'action existe bien
                           echo $controller->$action();

                        // Pour chaque erreur on affichera par défaut la liste des articles
                        }else{
                           $controller = new ArticleController(); 
                           echo $controller->indexAction();
                        }
                    }else{
                        $controller = new ArticleController();
                        echo $controller->indexAction();
                    }

                    
                    break;   
                default:
                    $controller = new ArticleController();
                    echo $controller->indexAction();
                    break;
            }
    }else{
        $controller = new ArticleController();
        echo $controller->indexAction();
    }
