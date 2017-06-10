<?php
    require_once('vendor/autoload.php');

    //on instance une nouvelle requête
    $newRequest = new Request();

    $newRouter = new Router($newRequest);

    $newRouter->dispatch($newRequest);


     // http://localhost/controller={controller}&action={action}


