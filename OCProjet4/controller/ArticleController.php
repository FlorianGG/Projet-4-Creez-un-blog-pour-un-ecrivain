<?php 
	namespace OCProjet4\controller;

	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\Article;
	use OCProjet4\model\Admin;
	use OCProjet4\controller\CommentController;
	use OCProjet4\view\View;
	use OCProjet4\app\App;	
	
	class ArticleController extends FrontController{

		//list all articles
		public function indexAction(){
			try {
				$articles = (new Article)->readAll();
				$data = [];
				if (empty($articles)) {
					$html = 'Rien à afficher';
				}

				foreach ($articles as $key => $value) {
					//on insère les données dans un tableau pour les envoyer dans la vue
					if (is_null($value->getIsDraft())) {
						$array = [];
						$array['id'] = $value->getId();
						$array['title'] = $value->getTitle();
						$array['content'] = $value->getContent();
						$array['dateArticle'] = $value->getDateArticle();
						$array['adminPseudo'] = (new Admin)->read($value->getAdminId())->getPseudo();
						$array['isDraft'] = $value->getIsDraft();

						$data[] = $array;
					}
				}
				$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
				return $this->response->setBody($html);
			} catch (\Exception $e) {
				throw new \Exception("Error Processing Request");
				
			}
			
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
				$code = 404;
			}else{
				$article = (new Article)->read($id);

				// récupère également les commentaires 
				$comments = (new CommentController($this->request,$this->response, $this->app))->indexAction();
				//si aucune erreur on affiche l'article selectionné
				if (!is_null($article)){
					//on insère les données dans un tableau pour les envoyer dans la vue
					if (is_null($article->getIsDraft())) {
						$data['article'] = [
							'id' => $article->getId(),
							'title' => $article->getTitle(),
							'content' => $article->getContent(),
							'dateArticle' => $article->getDateArticle(),
							'previousId'=>$this->checkIsArticleExist($article->previousId($article->getId())),
							'nextId'=>$this->checkIsArticleExist($article->nextId($article->getId())),
							'isDraft' => $article->getIsDraft()
							];
						//on insère les commentaires de l'article dans le tableau
						if (!is_null($comments)) {
							$data['comments'] = $comments;
						}else{
							$data['comments'] = 'Pas de commentaire';
						}
					}else{
						$this->app->addErrorMessage('Article introuvable');
						$code = 404;
						$path ='?controller=home&action=index';
						$this->response->redirectUrl($this->app->getUrl($path),$code);
					}
					
					//on définit l'action
					$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
					return $this->response->setBody($html);

				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					$this->app->addErrorMessage('Article introuvable');
					$code = 404;
				}
			}
			$path ='?controller=home&action=index';
			$this->response->redirectUrl($this->app->getUrl($path),$code);
		}

		
	}
?>
