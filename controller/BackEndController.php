<?php 
	namespace controller;
	use model\http\Request;
	use model\http\Response;
	use model\AuthAdmin;
	use view\View;

	
	
	class BackEndController extends BaseController{

		protected $auth;
		protected $article;

		public function __construct(Request $request, Response $response){
			parent::__construct($request,$response);
			$this->auth = (new AuthAdmin)->logged();
			if ($this->auth) {
				$this->article = new ArticleController($request, $response);
			}else{
				$this->authAction();

			}

		}

		public function indexAction(){
			$this->article->indexAction();
		}

		public function authAction(){
			$html = (new View($this->action))->generate();
			return $this->response->setBody($html);

		}

		// http://localhost?controller=backend&action=delete&id=3
		//effacer un article
		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$html = "<h2>Article introuvable </h2>";
			}else{
				$article = (new Article)->delete($id);
				if ($article) {
					$html = "<h2>L'article n°" . $id . " a bien été supprimé</h2";
				}elseif (is_null($article)) {
					$html = "<h2>Article introuvable</h2>";
				}
				else{
					$html = "Il y a eu une erreur d'éxécution, veuillez vérifier vos paramètres.";
				}
			}
			//on return le $html
			return $this->response->setBody($html);
		}
		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function addArticleAction(){
			$post = $this->request->getPost();
			$article = new Article($post);
			$newRecord = $article->save($article);
			if ($newRecord) {
				$html = 'L\'article a bien été ajouté';
			}else{
				$html = 'Une erreur est survenue';
			}
			//on return le $html 			
			return $this->response->setBody($html);
		}
	}
