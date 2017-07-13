<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use model\Admin;
	use controller\CommentController;
	use view\View;
	use app\App;	
	
	class ArticleController extends FrontController{

		//list all articles
		public function indexAction(){
			$articles = (new Article)->readAll();
			$data = [];
			if (empty($articles)) {
				$html = 'Rien à afficher';
			}

			foreach ($articles as $key => $value) {
				//on insère les données dans un tableau pour les envoyer dans la vue
				$array = [];
				$array['id'] = $value->getId();
				$array['title'] = $value->getTitle();
				$array['content'] = $value->getContent();
				$array['dateArticle'] = $value->getDateArticle();
				$array['adminPseudo'] = (new Admin)->read($value->getAdminId())->getPseudo();

				$data[] = $array;
			}
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		// http://localhost?controller=article&action=show&id=3
		//display one article 
		private function checkIsArticleExist($function){
			if (is_null($function)) {
				return null;
			}else{
				return $function->getId();
			}
		}
		public function showAction(){
			$id = (int)$this->request->getParam('id');
			if (is_null($id) OR !isset($id)) {
				$this->app->addErrorMessage('Article introuvable');
			}else{
				$article = (new Article)->read($id);

				$comments = (new CommentController($this->request,$this->response, $this->app))->indexAction();
				//si aucune erreur on affiche l'article selectionné
				if (!is_null($article)){
					//on insère les données dans un tableau pour les envoyer dans la vue
					$data['article'] = [
						'id' => $article->getId(),
						'title' => $article->getTitle(),
						'content' => $article->getContent(),
						'dateArticle' => $article->getDateArticle(),
						'previousId'=>$this->checkIsArticleExist($article->previousId($article->getId())),
						'nextId'=>$this->checkIsArticleExist($article->nextId($article->getId()))
						];
					//on insère les commentaires de l'article dans le tableau
					if (!is_null($comments)) {
						$data['comments'] = $comments;
					}else{
						$data['comments'] = 'Pas de commentaire';
					}
					
					//on définit l'action
					$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
					return $this->response->setBody($html);

				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					$this->app->addErrorMessage('Article introuvable');
				}
			}
			$path ='?controller=home&action=index';
			$this->response->redirectUrl($this->app->getUrl($path));
		}

		
	}
?>
