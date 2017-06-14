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
			if (isset($this->requestGet['controller']) && $this->requestGet['controller'] !== null) {
				switch ($this->requestGet['controller']) {
					//on ajoute un case article et on lance la fonction dispatch adaptée
					//on gardera cette logique pour les autres controllers
					case 'article':
						$this->dispatchArticle($request, $response);
						break;
					
					default:
						$this->redirectionErreur404();
						break;
				}
			}else{
				//on affiche la liste des articles sr l'index.php
				$articleControlleur = new ArticleController($request, $response);
				$action = 'indexAction';
				//on verifie que la méthode existe
				if (method_exists($articleControlleur, $action)) {
					echo $articleControlleur->$action();
				}
			}
		}

		public function dispatchArticle(Request $request, Response $response){
			if (isset($this->requestGet['action']) && $this->requestGet['action'] !== null) {
				switch ($this->requestGet['action']) {
					//affiche tous les articles
					case 'index':
						$articleControlleur = new ArticleController($request, $response);
						$action = $this->requestGet['action'] . 'Action';
						//on verifie que la méthode existe
						if (method_exists($articleControlleur, $action)) {
							echo $articleControlleur->$action();
						}
						break;
					//ajouter un article à partir d'un formulaire
					case 'addArticle':
						$articleControlleur = new ArticleController($request, $response);
						$action = $this->requestGet['action'] . 'Action';
						//on verifie que la méthode existe
						if (method_exists($articleControlleur, $action)) {
							echo $articleControlleur->$action($this->requestPost);
						}
						break;
					//on execute une fonction de l'articleCOntroller qui nécessite l'utilisation d'un ID : delete ou show
					default:
						if (isset($this->requestGet['id']) && $this->requestGet['id'] !== null){
							$id = (int)$this->requestGet['id'];
							$articleControlleur = new ArticleController($request, $response);
							$action = $this->requestGet['action'] . 'Action';
							//on verifie que la méthode existe
							if (method_exists($articleControlleur, $action)) {
								echo $articleControlleur->$action($id);
							}else{
								$this->redirectionErreur404();
							}
						}else{
								$this->redirectionErreur404();
						}
						break;
				}
			}else{
				$this->redirectionErreur404();
			}
		}

	}



?>
