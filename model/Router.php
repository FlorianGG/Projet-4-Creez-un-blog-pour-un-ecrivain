<?php
	namespace Model; 

	use model\http\Request;
	use model\http\Response;


	class Router{
		protected $request;
		protected $response;


		public function __construct(Request $request, Response $response){
			$this->request = $request;
			$this->response = $response;
		}

		//fonction qui renvoie une véritable erreur 404
		public function redirectionErreur404(){
					  header('HTTP/1.0 404 Not Found');
					  exit;		 
		}

		public function dispatch(){
			$controller = $this->request->getParam('controller');
			$action = $this->request->getParam('action');
			$id = $this->request->getParam('id');

			
			//on verifier que le controller est bien renseigné dans l'url

			if (isset($controller) && $controller != null) {
				//on crée une variable qui rajoute le namespace devant le fichier du controller
				$refController= 'controller\\' . ucfirst($controller . 'Controller');
				
				//on verifie que la class issue du controller dans l'url existe bien
				if (class_exists($refController)) {
					//on verifie que l'action existe bien dans l'url
					if (isset($action) && $action != null) {
						$refAction = $action . 'Action';
						if(method_exists($refController, $refAction)){
							return (new $refController($this->request, $this->response))->$refAction();
						}
					}
				}
			}
			//si une erreur dans l'url on renvoi une erreur 404
			$this->redirectionErreur404();
		}	
	}



?>
