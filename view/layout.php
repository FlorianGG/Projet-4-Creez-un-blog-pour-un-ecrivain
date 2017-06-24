<?php 
	namespace view;

	use model\http\Response;
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../web/css/style.css">

</head>
<body>
<?php 
	require('header.html');
?>
	<div class="content">
		<?php 
		echo $response;


		?>
	

	</div>
<?php 
	require('footer.html');
?>
