<?php
    namespace vendor;


    class Autoloader{
        static function register(){
            spl_autoload_register(array(__CLASS__,'autoload'));
        }

        static function autoload($class){
            $class = str_replace('\\', '/', $class);
            if (file_exists($class . '.php')) {
                require_once($class . '.php');
            }
        }
    }
?>
