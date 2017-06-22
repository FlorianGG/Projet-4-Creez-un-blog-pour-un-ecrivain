<?php
    namespace Vendor;


    class Autoloader{
        static function register(){
            spl_autoload_register(array(__CLASS__,'autoload'));
        }

        static function autoload($class){
            $class = str_replace('\\', '/', $class);
            if (file_exists($class . '.php')) {
                require_once($class . '.php');
            }



            // //on verifie que le fichier est bien dans le dossier controller
            // if (file_exists(__DIR__ . '/../' . $class . '.php')) {
            //     require_once(__DIR__ . '/../' . $class . '.php');
            // }elseif (file_exists(__DIR__ . '/../../' . $class . '.php')) {
            //    require_once(__DIR__ . '/../../' . $class . '.php');
            // }

                

            //     if (file_exists(__DIR__ . '/../model/classes/' . $class . '.php')) {
            //     require_once(__DIR__ . '/../model/classes/' . $class . '.php');
            // }elseif (file_exists(__DIR__ . '/../model/classes/manager/' . $class . '.php')) {
            //     require_once(__DIR__ . '/../model/classes/manager/' . $class . '.php');
            // }elseif (file_exists(__DIR__ . '/../model/http/' . $class . '.php')) {
            //     require_once(__DIR__ . '/../model/http/' . $class . '.php');
            // }elseif (file_exists(__DIR__ . '/../model/' . $class . '.php')) {
            //     require_once(__DIR__ . '/../model/' . $class . '.php');

        }
    }



    


?>
