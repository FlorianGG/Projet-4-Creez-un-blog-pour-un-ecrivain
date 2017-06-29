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
	}

?>
