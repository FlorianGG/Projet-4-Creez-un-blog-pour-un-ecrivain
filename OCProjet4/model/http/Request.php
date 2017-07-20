<?php 
	namespace OCProjet4\model\http;
	

	class Request{
		private $get;
		private $post;

		public function __construct(){
			$this->get = $_GET;
			$this->post = $_POST;
		}

		//fonction qui vérifie si la variable GET existe et la retourne nettoyée
		public function getParam($param){
			if (isset($this->get[$param]) && !is_null($this->get[$param])) {
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





	}





?>
