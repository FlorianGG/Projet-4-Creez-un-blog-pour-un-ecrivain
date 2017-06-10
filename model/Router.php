<?php 
	class Router{
		protected $request;

		public function __construct(Request $request){
			$this->request = $request->getParams();
		}

		//fonction qui renvoie une véritable erreur 404
		public function redirectionErreur404(){
		  header('HTTP/1.0 404 Not Found');
		  exit;
		}


		public function dispatch(Request $request){
			if (isset($this->request['controller']) && $this->request['controller'] !== null) {
				switch ($this->request['controller']) {
					case 'article':
						$this->dispatchArticle($request);
						break;
					
					default:
						$this->redirectionErreur404();
						break;
				}
			}else{
				$this->redirectionErreur404();
			}
		}

		public function dispatchArticle(Request $request){
			if (isset($this->request['action']) && $this->request['action'] !== null) {
				switch ($this->request['action']) {
					//affiche tous les articles
					case 'index':
						// $newRequest = new Request;
						$articleControlleur = new ArticleController($request);
						$action = $this->request['action'] . 'Action';
						//on verifie que la méthode existe
						if (method_exists($articleControlleur, $action)) {
							echo $articleControlleur->$action();
						}
						break;
					//affiche un article
					case 'show':
						if (isset($this->request['id']) && $this->request['id'] !== null){
							$id = (int)$this->request['id'];
							$articleControlleur = new ArticleController($request);
							$action = $this->request['action'] . 'Action';
							//on verifie que la méthode existe
							if (method_exists($articleControlleur, $action)) {
								echo $articleControlleur->$action($id);
							}
						}
						break;
					case 'delete':
						//à terminer
						break;
					default:
						$this->redirectionErreur404();
						break;
				}
			}else{
				$this->redirectionErreur404();
			}
		}

	}



?>
