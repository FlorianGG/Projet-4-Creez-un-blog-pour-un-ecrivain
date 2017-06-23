<?php 
 	namespace model\http;

	 
	class Response{
		protected $_html;

		//function setter qui renvoi le html en paramètre
		public function setBody($html){
			$this->_html = $html;
		}

		//function qui permet de faire un echo de l'objet
		public function __toString(){
			return $this->_html;
		}
	}

?>
