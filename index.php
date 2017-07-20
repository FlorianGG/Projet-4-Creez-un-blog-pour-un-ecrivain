<?php
    session_start();
    
    use OCProjet4\model\http\Request;
    use OCProjet4\model\http\Response;
    use OCProjet4\model\Router;
    use OCProjet4\app\App;
    use OCProjet4\helper\VisitCount;
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





