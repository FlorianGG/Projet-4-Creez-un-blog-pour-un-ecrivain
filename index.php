<!-- <!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
</head>
<body>
 -->

<?php
    require_once('vendor/autoload.php');

    //on instance une nouvelle requête
    // $newRequest = new Request();

    // //on instance une nouvelle reponse
    // $response = new Response;

    // $newRouter = new Router($newRequest, $response);

    // $newRouter->dispatch($newRequest, $response);

    // echo $response;

    // $ManagerAdmin = new ManagerAdmin;
    // $admin = $ManagerAdmin->readByEmail('admin@gmail.com');
    // var_dump($admin);



// </body>
// </html> -->

$test = ['title'=>'qsdfnijkslf,vodkl', 'content'=>'qdnfsdopêkfogibnjkl,fr', 'adminId'=>1];

$art = new Article($test);

$newArt = new ManagerArticle;

$newArticle = $newArt->create($art);



?>



