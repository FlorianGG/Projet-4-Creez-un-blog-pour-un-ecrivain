<?php
    session_start();
    
    use SRC\model\http\Request;
    use SRC\model\http\Response;
    use SRC\model\Router;
    use SRC\app\App;
    use SRC\helper\VisitCount;
    use Symfony\Component\Yaml\Yaml;

    require_once('vendor/autoload.php');
    (new VisitCount)->countVisitor();

    //on instancie une nouvelle app
    $app = new App;

    //on instance une nouvelle requête
    $request = new Request;

    //on instance une nouvelle reponse
    $response = new Response;

    $router = new Router($request, $response, $app);

    $router->dispatch();
    
    echo $response;
?>





