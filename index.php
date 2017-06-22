<?php
    use Vendor\Autoloader;
    use Model\Http\Request;
    use Model\Http\Response;
    use Model\Router;

    // //Test
    // use Model\Classes\Models\Admin;
    // use Model\Classes\Manager\AdminManager;
    // use Model\Classes\Models\User;
    // use Model\Classes\Manager\UserManager;
    // use Model\Classes\Models\Comment;
    // use Model\Classes\Manager\CommentManager;

    require_once('Vendor/Autoloader.php');
    Autoloader::register();

    //on instance une nouvelle requête
    $request = new Request();

    //on instance une nouvelle reponse
    $response = new Response;


    $router = new Router($request, $response);

    $router->dispatch($request, $response);
    echo $response;

    // //TEST ADMIN
    // $testAdmin = ['pseudo'=>'test1', 'email'=>'test2@gmail.fr', 'pass'=>'test'];
    // $newAdmin = new Admin($testAdmin);
    // $newAdmin->save($newAdmin);


    // var_dump(Admin::loadByEmail('test2@gmail.fr'));
    // $deleteAdmin = new AdminManager;
    // $deleteAdmin->delete(14);



    // //TEST USER
    // $testUser = ['pseudo'=>'test1', 'email'=>'test4@gmail.fr', 'pass'=>'test'];
    // $newUser = new User($testUser);
    // $newUser->save($newUser);
    
    // var_dump(User::loadByEmail('test1@gmail.fr'));
    // $deleteUser = new UserManager;
    // $deleteUser->delete(3);


    
    //TEST COMMENT
    
    // $testComment = ['content'=>'testComment', 'dateComment'=>date("Y-m-d H:i:s"), 'idParent'=> 0, 'userId'=> 1, 'articleId'=> 2];
    // $newComment = new Comment($testComment);
    // $newComment->save($newComment);
    
    // $deleteComment = new CommentManager;
    // $deleteComment->delete(2);

    
    ?>

<!-- 
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test</title>
            <meta charset="utf-8">
        </head>
        <body>
        
        <form action="index.php?controller=article&action=addArticle" method="post">
           <fieldset>
             <legend>Nouvel Article:</legend>
             <p><label for="title">Titre de l'article : <input type="text" name="title"  id="title" placeholder="Titre de l'article"></label></p>
             <p><label for="content"></label>Contenu de votre article : </p>
          <p><textarea name="content" id="content" placeholder="Contenu de votre article" rows="15" cols="100"></textarea></p>
             <input type="hidden" name="adminId" value="1">
             <input type="hidden" name="dateArticle" value="< echo date("Y-m-d H:i:s");?>">
             <input type="submit" value="Submit">
           </fieldset>
         </form>
     </body>
     </html> -->





