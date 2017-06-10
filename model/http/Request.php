<?php 
	class Request{
		private $get;
		private $post;

		public function __construct(){
			$this->get = $_GET;
			$this->post = $_POST;
		}

		public function getParam($param){
			if (isset($this->get[$param]) && $this->get[$param] != "") {
				$param = htmlspecialchars($param);
				return $this->get[$param];
			}else{
				return null;
			}
		}

		public function getParams(){
			$request = [];
			foreach ($this->get as $key => $value) {
				$value = $this->getParam($key);
				$request[$key] = $value;
			}
			return $request;
		}




	}





?>
