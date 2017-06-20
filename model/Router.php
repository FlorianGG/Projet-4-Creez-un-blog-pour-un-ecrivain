<?php 
	class Router{
		protected $requestGet;
		protected $requestPost;


		public function __construct(Request $request, Response $response){
			$this->requestGet = $request->getParams();
			$this->requestPost = $request->getPost();
		}

		//fonction qui renvoie une véritable erreur 404
		public function redirectionErreur404(){
		  header('HTTP/1.0 404 Not Found');
		  exit;
		}

		public function dispatch(Request $request, Response $response){
			$controller = $request->getParam('controller');
			$action = $request->getParam('action');
			//on verifier que le controller est bien renseigné dans l'url
			if (isset($this->requestGet['controller']) && $this->requestGet['controller'] != null) {

				//on verifie que la class issue du controller dans l'url existe bien
				if (class_exists(ucfirst($this->requestGet['controller'] . 'Controller'))) {
					$class = ucfirst($this->requestGet['controller'] . 'Controller');
					//on verifie que l'action existe bien dans l'url
					if (isset($this->requestGet['action']) && $this->requestGet['action'] != null) {
						if(method_exists($class, $this->requestGet['action'] . 'Action')){
							$action = $this->requestGet['action'] . 'Action';
							if (isset($this->requestGet['id']) && $this->requestGet['id'] != null) {
								$id =(int)$this->requestGet['id'];
								return (new $class($request, $response))->$action($id);
							}else{
								return (new $class($request, $response))->$action();
							}
						}else{
							
						}
					}else{
						
					}
				}else{
					$this->redirectionErreur404();
				}
				$this->redirectionErreur404();
			}else{
				$this->redirectionErreur404();
			}
		}
	}



?>
