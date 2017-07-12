<?php 
	namespace app;

	class App{
		public function getUrl($path){
			$url = 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/' . $path;
			return $url;
		}

		public function addSuccessMessage($message){
			$_SESSION['successMessage']= $message;
		}

		public function addErrorMessage($message){
			$_SESSION['errorMessage']= $message;
		}
	}

?>
