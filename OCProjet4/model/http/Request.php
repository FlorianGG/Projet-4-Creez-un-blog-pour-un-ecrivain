<?php 
	namespace OCProjet4\model\http;
	

	class Request{
		private $get;
		private $post;

		// class qui récupère les variables  SESSION get et post pour les nettoyer
		// on initialise les var get et post avec les variables SESSIONS
		public function __construct(){
			$this->get = $_GET;
			$this->post = $_POST;
		}

		//fonction qui vérifie si la variable GET existe et la retourne nettoyée
		public function getParam($param){
			if (isset($this->get[$param]) && !is_null($this->get[$param])) {
				// on applique un filtre SPECIAL CHARS
				$param = filter_var($param, FILTER_SANITIZE_SPECIAL_CHARS);
				return $this->get[$param];
			}else{
				return null;
			}
		}

		//fonction qui execute pour chaque variable GET la fonction getParam et push les variables dans un array
		public function getParams(){
			$request = [];
			foreach ($this->get as $key => $value) {
				$value = $this->getParam($key);
				$request[$key] = $value;
			}
			return $request;
		}

		//fonction qui récupère les variables POST les nettoie et les push dans un array
		public function getPost(){
			$request = [];
			foreach ($this->post as $key => $value) {
				if (isset($this->post[$key]) && !is_null($this->post[$key])) {
					$value = filter_var($this->post[$key], FILTER_SANITIZE_SPECIAL_CHARS);
					$request[$key] = $value;
				}else{
					return null;
				}
			}
			return $request;
		}

		//fonction qui vérifie la conformité des champs de formulaire type utilisateur ou admin
		//on applique nos fonctions filtre crée avec des expressions régulières
		//pour imposer une taille minimum des données saisies
		public function checkForm(array $post){
			$options = array(
				'title' => array(
					'filter' => FILTER_CALLBACK,
					'options' => array($this,'checkLenghtTitle')
					),
				'content' => array(
					'filter' => FILTER_CALLBACK,
					'options' => array($this,'checkLenghtContent')
					),
				'pseudo' => array(
					'filter' => FILTER_CALLBACK,
					'options' => array($this,'checkLenghtPerson')
					),
				'email' => FILTER_VALIDATE_EMAIL,
				'pass' => array(
					'filter' => FILTER_CALLBACK,
					'options' => array($this,'checkLenghtPerson')
					)
				);

			$result = filter_var_array($post, $options, false);
			foreach ($result as $key => $value) {
				if (!$value) {
					return false;
				}
			}
			return true;
		}

		//fonction callback qui vérifie la longueur d'un champ
		private function checkLenghtPerson($string) {
		    //Retourne la string si elle est valide, sinon false.
		    $reg = '/^[a-zA-Z0-9_.-]{3,16}$/';
		    if (preg_match($reg,$string)) {
		    	return $string;
		    }else{
		    	return false;
		    }
		}

		//fonction callback qui vérifie la longueur d'un champ
		private function checkLenghtTitle($string) {
			//Retourne la string si elle est valide, sinon false.
			$reg = '/[a-zA-Z0-9_.-]{2,}/';
			if (preg_match($reg,$string)) {
				return $string;
			}else{
				return false;
			}
		}

		//fonction callback qui vérifie la longueur d'un champ
		//Principalement pour le content saisie vi tinyMCE
		private function checkLenghtContent($string) {
			//nettoie les balises script
			$regScript = '/[&#38;lt;script&#38;]/';
			$string = preg_replace($regScript, '', $string);
			//Retourne la string si elle est valide, sinon false.
			$reg = '/^[^\s].{5,}/';

			if (preg_match($reg,$string)) {
				return $string;
			}else{
				return false;
			}
		}

	}





?>
