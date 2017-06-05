<?php 
    // fonction autoloader qui charge les class et les managers de class lors de la création d'un objet'
    function autoloader($class){
    	if (file_exists(__DIR__ . '/../controller/' . $class . '.php')) {
    		require_once(__DIR__ . '/../controller/' . $class . '.php');
    	}elseif (file_exists(__DIR__ . '/../model/classes/' . $class . '.php')) {
    		require_once(__DIR__ . '/../model/classes/' . $class . '.php');
    	}

    	
    }

    spl_autoload_register('autoloader');


    


?>
