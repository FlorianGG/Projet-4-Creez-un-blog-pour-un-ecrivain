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
    $newRequest = new Request();

    //on instance une nouvelle reponse
    $response = new Response;

    $newRouter = new Router($newRequest, $response);

    $newRouter->dispatch($newRequest, $response);

    echo $response;

// <!-- <form action="index.php?controller=article&action=addArticle" method="post">
//   <fieldset>
//     <legend>Nouvel Article:</legend>
//     <p><label for="title">Titre de l'article : <input type="text" name="title"  id="title" placeholder="Titre de l'article"></label></p>
//     <p><label for="content"></label>Contenu de votre article : </p>
// 	<p><textarea name="content" id="content" placeholder="Contenu de votre article" rows="15" cols="100"></textarea></p>
//     <input type="hidden" name="adminId" value="1">
//     <input type="submit" value="Submit">
//   </fieldset>
// </form>


// </body>
// </html> -->



?>

