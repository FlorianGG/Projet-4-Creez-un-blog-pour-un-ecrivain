<?php 
    // fonction autoloader qui charge les class et les managers de class lors de la création d'un objet'
    function autoloader($class){
        include(__DIR__ . '/../model/class/' . $class . '.php');
    }
    spl_autoload_register('autoloader');
?>
