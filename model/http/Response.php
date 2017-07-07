<?php 
 	namespace model\http;

	 
	class Response{
		protected $html;

		//function setter qui renvoi le html en paramètre
		public function setBody($html){
			$this->html = $html;
		}

		//function qui permet de faire un echo de l'objet
		public function __toString(){
			return $this->html;
		}

		//fonction qui renvoie une erreur avec en paramètre le code erreur et le message
		public function redirect($code, $message){
			header('HTTP/1.0 ' . $code . ' ' . $message);
			exit;		 
		}

		//fonction qui redirige vers une autre url
		public function redirectUrl($url, $code = 200){//revoir comme utiliser la variable $code
			header('Location:'. $url);
			exit();
		}
	}

?>
