<?php 
	namespace OCProjet4\app;

	use Symfony\Component\Yaml\Yaml;

	class App{
		public function getUrl($path){
			$array = Yaml::parse(file_get_contents('config.yml'));
			$domain = Yaml::dump($array['url'], 1);
			$url = str_replace('\'','', $domain) . $path;
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
			if (isset($_SESSION['successMessage']) && !is_null($_SESSION['successMessage'])) {
				return $_SESSION['successMessage'];
			}else{
				return null;
			}
		}

		public function getErrorMessage(){
			if (isset($_SESSION['errorMessage']) && !is_null($_SESSION['errorMessage'])) {
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
