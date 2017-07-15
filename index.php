<?php
    session_start();
    
    use vendor\Autoloader;
    use model\http\Request;
    use model\http\Response;
    use model\Router;
    use app\App;
    use helper\VisitCount;

    //Test
    // use model\Article;
    // use model\manager\ArticleManager;
    // use model\Admin;
    // use model\manager\AdminManager;
    // use model\User;
    // use model\manager\UserManager;
    // use model\Comment;
    // use model\manager\CommentManager;
    // use model\ModelPersonAbstract;
    // use model\Biography;


    require_once('vendor/Autoloader.php');
    Autoloader::register();

    (new VisitCount)->countVisitor();
    // var_dump((new VisitCount)->getNb());


    // $test = '<h1>qgsdhbfjnsdfhegisohdgfoeuisjgk,hl;g</h1>';

    // $ajout =(new Biography)->setContent($test);
    // var_dump($ajout);
    // echo (new Biography)->getContent();

    //on instancie une nouvelle app
    $app = new App;

    //on instance une nouvelle requête
    $request = new Request;

    //on instance une nouvelle reponse
    $response = new Response;

    $router = new Router($request, $response, $app);

    $router->dispatch();
    
    echo $response;



    // // //TEST ADMIN
    // $testAdmin = ['pseudo'=>'admin', 'email'=>'test@gmail.fr', 'pass'=>'test'];
    // $newAdmin = new Admin($testAdmin);
    // $newAdmin->save($newAdmin);


    // var_dump((new Admin)->loadByEmail('test2@gmail.fr'));
    // $deleteAdmin = new AdminManager;
    // $deleteAdmin->delete(14);



    //TEST USER
    // $testUser = ['pseudo'=>'test4', 'email'=>'test4@gmail.fr', 'pass'=>'john'];
    // $newUser = new User($testUser);
    // $newUser->save($newUser);
    
    // var_dump((new User)->loadByEmail('test1@gmail.fr'));
    // $deleteUser = new UserManager;
    // $deleteUser->delete(3);


    
    //TEST COMMENT
    
    // $testComment = ['content'=>'testComment', 'dateComment'=>date("Y-m-d H:i:s"), 'idParent'=> 0, 'userId'=> 1, 'articleId'=> 2];
    // $newComment = new Comment($testComment);
    // $newComment->save($newComment);
    
    // $deleteComment = new CommentManager;
    // $deleteComment->delete(2);

    
    ?>





