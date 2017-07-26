<?php 
	namespace OCProjet4\controller\admin;

	use OCProjet4\controller\BackEndController;
	use OCProjet4\model\Article;
	use OCProjet4\model\Comment;
	use OCProjet4\model\Admin;
	use OCProjet4\model\User;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;

	class CommentController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		//list all articles
		public function indexAction(){
			$id = (int) $this->request->getParam('id');
			$data = [];
			$comments = (new Comment)->readAllWithArticle($id);
			if (empty($comments)) {
				return $comments;
			}else{
				foreach ($comments as $key => $value) {
					//on insère les données dans un tableau pour les envoyer dans la vue
					$array = [];
					$array['id'] = $value->getId();
					$array['content'] = $value->getContent();
					$array['dateComment'] = $value->getDateComment();
					$array['userPseudo'] = (new User)->read($value->getUserId())->getPseudo();
					$array['articleTitle'] = (new Article)->read($value->getArticleId())->getTitle();	
					$array['articleId'] = $value->getArticleId();			
					$array['idParent'] = $value->getIdParent();
					//On ajoute le tout dans un tableau qu'on renvoie dans la vue
					$data[$array['id']] = $array;
				}
				$array = [];
				foreach ($data as $comment => $com) {
					if ($data[$comment]['idParent'] === 0) {
						$array[$data[$comment]['id']]= $data[$comment];
					}else{

						$array[$data[$comment]['idParent']]['response'][$comment] = $data[$comment];
					}
				}
				return $array;
			}
		}

		//effacer un commentaire
		public function deleteAction(){
			$articleId = $this->request->getParam('article');
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$this->app->addErrorMessage('Commentaire introuvable');
			}else{
				$articleDelete = (new Comment)->delete($id);
				if ($articleDelete) {
					$this->app->addSuccessMessage('Le commentaire n°' . $id . ' a bien été supprimé');
					$code = 200;
				}elseif (is_null($article)) {
					$this->app->addErrorMessage('Commentaire introuvable');
					$code = 404;
				}
				else{
					$this->app->addErrorMessage('Il y a eu une erreur d\'éxécution, veuillez vérifier vos paramètres.');
					$code = 404;
				}
			}
			$path ='?interface=admin&controller=article&action=show&id=' . $articleId;
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function saveAction(){
			$post = $this->request->getPost();
			$reg = '/^[^\s]\w*/';
			if (!preg_match($reg,$post['content'])) {
				$this->app->addErrorMessage('Le text de votre commentaire n\'est pas conforme');
				$code = 200;
				$comment = new Comment($post);
			}else{
				$comment = new Comment($post);
				$newRecord = $comment->save($comment);
				if ($newRecord) {
					if (!empty($post['id'])) {
						$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
						$code = 200;
					}else{
						$this->app->addSuccessMessage('Le commentaire a bien été ajouté');
						$code = 200;
					}
				}else{
					$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
					$code = 404;
				}
			}
			$path ='?interface=admin&controller=article&action=show&id=' . $comment->getArticleId();
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}

		// http://localhost?controller=article&action=show&id=3
		//display one article 
		public function showAction(){
			$id = (int)$this->request->getParam('id');
			if (is_null($id) OR !isset($id)) {
				$this->app->addErrorMessage('Article introuvable');
				$code = 404;
			}else{
				$article = (new Article)->read($id);
				//si aucune erreur on affiche l'article selectionné
				if (!is_null($article)){
					//on insère les données dans un tableau pour les envoyer dans la vue
					$data = [
						'id' => $article->getId(),
						'title' => $article->getTitle(),
						'content' => $article->getContent(),
						'dateArticle' => $article->getDateArticle()
						];
					//on définit l'action
					$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
					return $this->response->setBody($html);

				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					$this->app->addErrorMessage('Article introuvable');
					$code = 404;
				}
			}
			
			$path ='?interface=admin&controller=' . $this->controller . '&action=index';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}



?>
