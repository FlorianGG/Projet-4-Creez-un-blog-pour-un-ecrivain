<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use controller\admin\CommentController;
	use model\Article;
	use model\Admin;
	use model\User;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

	class ArticleController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		private function checkIsArticleExist($function){
			if (is_null($function)) {
				return null;
			}else{
				return $function->getId();
			}
		}

		//list all articles
		public function indexAction(){
			$articles = (new Article)->readAll();
			$data = [];

			foreach ($articles as $key => $value) {
				//on insère les données dans un tableau pour les envoyer dans la vue
				$array = [];
				$array['id'] = $value->getId();
				$array['title'] = $value->getTitle();
				$array['content'] = $value->getContent();
				$array['dateArticle'] = $value->getDateArticle();
				$array['adminPseudo'] = (new Admin)->read($value->getAdminId())->getPseudo();


				//On ajoute le tout dans un tableau qu'on renvoie dans la vue
				$data[] = $array;
			}

			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		// http://localhost?controller=backend&action=delete&id=3
		//effacer un article
		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$this->app->addErrorMessage('Article introuvable');
			}else{
				$articleDelete = (new Article)->delete($id);
				if ($articleDelete) {
					$this->app->addSuccessMessage('L\'article n°' . $id . ' a bien été supprimé');
				}elseif (is_null($article)) {
					$this->app->addErrorMessage('Article introuvable');
				}
				else{
					$this->app->addErrorMessage('Il y a eu une erreur d\'éxécution, veuillez vérifier vos paramètres.');
				}
			}
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path));
		}
		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function saveAction(){
			$post = $this->request->getPost();
			$article = new Article($post);
			$newRecord = $article->save($article);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
				}else{
					$this->app->addSuccessMessage('L\'article a bien été ajouté');
				}
			}else{
				$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
			}
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path));
		}

		// http://localhost?controller=article&action=show&id=3
		//display one article 
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
			//on return le $html
			
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path));
		}
	}



?>
