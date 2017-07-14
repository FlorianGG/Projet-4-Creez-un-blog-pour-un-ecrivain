<?php 
	namespace app;

	class App{
		public function getUrl($path){
			$url = 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/' . $path;
			return $url;
		}

		// Gestion des messages de succès ou d'erreur
		public function addSuccessMessage($message){
			$_SESSION['successMessage']= $message;
		}

		public function addErrorMessage($message){
			$_SESSION['errorMessage']= $message;
		}

		public function getSuccessMessage(){
			if (!is_null($_SESSION['successMessage'])) {
				return $_SESSION['successMessage'];
			}else{
				return null;
			}
		}

		public function getErrorMessage(){
			if (!is_null($_SESSION['errorMessage'])) {
				return $_SESSION['errorMessage'];
			}else{
				return null;
			}
		}

		function deleteMessage(){
			$_SESSION['errorMessage'] = null;
			$_SESSION['successMessage'] = null;
		}
	}

?>
