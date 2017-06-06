<?php 
    // fonction autoloader qui choisit le bon controlleur
    function autoloader($class){
        //on verifie que le fichier est bien dans le dossier controller
    	if (file_exists(__DIR__ . '/../controller/' . $class . '.php')) {
    		require_once(__DIR__ . '/../controller/' . $class . '.php');

            //sinon on le recherche dans dans le dossier model/classes
    	}elseif (file_exists(__DIR__ . '/../model/classes/' . $class . '.php')) {
    		require_once(__DIR__ . '/../model/classes/' . $class . '.php');
    	}

    	
    }

    spl_autoload_register('autoloader');


    


?>
