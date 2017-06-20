<?php
    require_once('vendor/autoload.php');

    //on instance une nouvelle requête
    $newRequest = new Request();

    //on instance une nouvelle reponse
    $response = new Response;

    $newRouter = new Router($newRequest, $response);

    $newRouter->dispatch($newRequest, $response);
    echo $response;

    // //TEST ADMIN
    // $testAdmin = ['pseudo'=>'test1', 'email'=>'test1@gmail.fr', 'pass'=>'test'];
    // $newAdmin = new Admin($testAdmin);
    // $newAdmin->save($newAdmin);


    // var_dump(Admin::loadByEmail('test@gmail.fr'));

    // //TEST USER
    // $testUser = ['pseudo'=>'test1', 'email'=>'test1@gmail.fr', 'pass'=>'test'];
    // $newUser = new User($testUser);
    // $newUser->save($newUser);
    
    // var_dump(User::loadByEmail('test@gmail.fr'));



    
    // //TEST COMMENT
    
    // $testComment = ['content'=>'testComment', 'dateComment'=>date("Y-m-d H:i:s"), 'idParent'=> 0, 'userId'=> 1, 'articleId'=> 1];
    // $newComment = new Comment($testComment);
    // $newComment->save($newComment);

    
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





