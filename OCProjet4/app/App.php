<?php 
	namespace OCProjet4\app;

	use Symfony\Component\Yaml\Yaml;

	class App{
		protected $config;

		// fonction qui récupère le chemin et rajoute l'url configuré dans config.yml
		public function getUrl($path){
			$domain = $this->getConfig()['domain'];
			$url = str_replace('\'','', $domain) . $path;
			return $url;
		}


		//function qui permet de ne parser qu'une fois le fichier config
		private function getConfig(){
			if (is_null($this->config)) {
				$array = Yaml::parse(file_get_contents('config.yml'));
				$this->config = [];
				$this->config['domain'] = Yaml::dump($array['url'], 1);
			}
			return $this->config;
		}

		// fonction ajoute le message en paramètre à la variable SESSION 'successMessage'
		// on utilise cette fonction dans le controller
		public function addSuccessMessage($message){
			$_SESSION['successMessage']= $message;
		}

		// fonction ajoute le message en paramètre à la variable SESSION 'errorMessage'
		// on utilise cette fonction dans le controller
		public function addErrorMessage($message){
			$_SESSION['errorMessage']= $message;
		}

		//fonction qui renvoi un null si aucun message success n'a été ajouté
		//fonction qu'on utilise dans la vue
		public function getSuccessMessage(){
			if (isset($_SESSION['successMessage']) && !is_null($_SESSION['successMessage'])) {
				return $_SESSION['successMessage'];
			}else{
				return null;
			}
		}

		//fonction qui renvoi un null si aucun message success n'a été ajouté
		//fonction qu'on utilise dans la vue
		public function getErrorMessage(){
			if (isset($_SESSION['errorMessage']) && !is_null($_SESSION['errorMessage'])) {
				return $_SESSION['errorMessage'];
			}else{
				return null;
			}
		}

		// fonction qui delete un message en réinitiallisant les variables SESSIONS
		function deleteMessage(){
			$_SESSION['errorMessage'] = null;
			$_SESSION['successMessage'] = null;
		}
	}

?>
