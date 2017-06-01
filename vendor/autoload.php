<?php

    // TODO : update autoloader function in order to require all classes (Controllers, Models)
    // TODO : use require_once instead of include
    // fonction autoloader qui charge les class et les managers de class lors de la création d'un objet'
    function autoloader($class){
        include(__DIR__ . '/../model/class/' . $class . '.php');
    }
    spl_autoload_register('autoloader');
?>
