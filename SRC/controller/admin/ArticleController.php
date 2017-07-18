<?php 
	namespace SRC\controller\admin;

	use SRC\controller\BackEndController;
	use SRC\controller\admin\CommentController;
	use SRC\model\Article;
	use SRC\model\Admin;
	use SRC\model\User;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\view\View;
	use SRC\app\App;
	use SRC\helper\Image;

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
				$array['isDraft'] = $value->getIsDraft();


				//On ajoute le tout dans un tableau qu'on renvoie dans la vue
				$data[] = $array;
			}

			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		//Page permettant la creation ou la modification d'un article si $key existe
		public function recordAction(){
			if (!is_null($this->request->getParam('id'))) {
				$id = $this->request->getParam('id');
				$article = (new Article)->read($id);
				if (!is_null($article)){
					//on insère les données dans un tableau pour les envoyer dans la vue
					$data['article'] = [
						'id' => $article->getId(),
						'title' => $article->getTitle(),
						'content' => $article->getContent(),
						'dateArticle' => $article->getDateArticle(),
						'previousId'=>$this->checkIsArticleExist($article->previousId($article->getId())),
						'nextId'=>$this->checkIsArticleExist($article->nextId($article->getId())),
						'isDraft'=> $article->getIsDraft(),
						];
						if (!is_null($article->getIsDraft())) {
							$this->app->addSuccessMessage('Décoché la case \'Brouillon\' pour publier l\'article');
							$code = 200;
						}
					//on définit l'action
					$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
					return $this->response->setBody($html);
				}					
			}
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		// http://localhost?controller=backend&action=delete&id=3
		//effacer un article
		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$this->app->addErrorMessage('Article introuvable');
				$code = 404;
			}else{
				$articleDelete = (new Article)->delete($id);
				$fileDelete = (new Image)->deleteImg($id);
				if ($articleDelete) {
					$this->app->addSuccessMessage('L\'article n°' . $id . ' a bien été supprimé');
					$code = 200;
				}elseif (is_null($article)) {
					$this->app->addErrorMessage('Article introuvable');
					$code = 404;
				}
				else{
					$this->app->addErrorMessage('Il y a eu une erreur d\'éxécution, veuillez vérifier vos paramètres.');
					$code = 404;
				}
			}
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function saveAction(){
			$post = $this->request->getPost();
			$article = new Article($post);
			$newRecord = $article->save($article);
			$img = (new Image)->validateImgArticle('imageArticle', $article->getId());
			if ($newRecord) {
				if (!empty($post['id'])) {
					$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
					$code = 200;
				}else{
					$this->app->addSuccessMessage('L\'article a bien été ajouté');
					$code = 200;
				}
			}else{
				$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
				$code = 404;
			}
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}

		// http://localhost?controller=article&action=show&id=3
		//display one article 
		public function showAction(){
			if (is_null($this->request->getParam('id'))) {
				$this->app->addErrorMessage('Article introuvable');
				$code = 404;
			}else{
				$id = (int)$this->request->getParam('id');
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
					$code = 404;
				}
			}
			//on return le $html
			
			$path ='?interface=admin&controller=article&action=index';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}



?>
