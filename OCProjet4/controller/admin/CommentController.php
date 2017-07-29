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

		//liste tous les commentaires
		public function indexAction(){
			$id = (int) $this->request->getParam('id');
			$data = [];
			// On récupère tous les commentaires associés à un article via son $id
			$comments = (new Comment)->readAllWithArticle($id);
			if (empty($comments)) {
				// si on a rien on renvoi le contenu de comments soit null
				return $comments;
			}else{
				// on crée une boucle pour récupérer tous les comments
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
				// on class les comments selon si l'idParent
				// Si null on met dans tableau principale
				// si non on crée un tableau réponse au tableau id parent et on les class par id
				foreach ($data as $comment => $com) {
					if ($data[$comment]['idParent'] === 0) {
						$array[$data[$comment]['id']]= $data[$comment];
					}else{

						$array[$data[$comment]['idParent']]['response'][$comment] = $data[$comment];
					}
				}
				// on retourne un tableau
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


		//ajouter un commentaire ou le modifier
		public function saveAction(){
			$post = $this->request->getPost();
			$comment = new Comment($post);
			if($this->request->checkForm($post)){
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
			}else{
				$this->app->addErrorMessage('Votre commentaire ne respecte pas la longueur minimale');
				$code = 200;
			}
			$path ='?interface=admin&controller=article&action=show&id=' . $comment->getArticleId();
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}



?>
