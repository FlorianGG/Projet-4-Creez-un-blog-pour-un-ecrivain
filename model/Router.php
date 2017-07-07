<?php
	namespace Model; 

	use model\http\Request;
	use model\http\Response;
	use app\App;


	class Router{
		protected $request;
		protected $response;
		protected $app;


		public function __construct(Request $request, Response $response, App $app){
			$this->request = $request;
			$this->response = $response;
			$this->app = $app;
		}

		public function dispatch(){
			$interface = $this->request->getParam('interface');
			$controller = $this->request->getParam('controller');
			$action = $this->request->getParam('action');

			//on verifier que le controller est bien renseigné dans l'url

			if (isset($controller) && $controller != null) {
				if (isset($interface) && $interface != null) {
					//on crée une variable qui rajoute un namespace différent devant le fichier du controller sous condition que $interface existe
					$refController= 'controller\\admin\\' . ucfirst($controller . 'Controller');
				}else{
					//on crée une variable qui rajoute le namespace devant le fichier du controller
					$refController= 'controller\\' . ucfirst($controller . 'Controller');
				}
				
				//on verifie que la class issue du controller dans l'url existe bien
				if (class_exists($refController)) {
					//on verifie que l'action existe bien dans l'url
					if (isset($action) && $action != null) {
						$refAction = $action . 'Action';
						if(method_exists($refController, $refAction)){
							return (new $refController($this->request, $this->response, $this->app))->$refAction();
						}
					}
				}
			}
			// si une erreur dans l'url on renvoi une erreur 404
			$this->response->redirect('404', 'Not found');
		}	
	}



?>
