<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Article;
	use model\Comment;
	use model\Admin;
	use model\User;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

	class CommentController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		//list all articles
		public function indexAction(){
			$data = [];
			$comments = (new Comment)->readAll();

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
				$data[] = $array;

			}
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		//Affiche les comments d'un article
		public function displayAction(){
			$id = (int) $this->request->getParam('id');
			$data = null;
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
					$array['userId'] = $value->getUserId();
					$array['userPseudo'] = (new User)->read($value->getUserId())->getPseudo();
					$array['articleTitle'] = (new Article)->read($value->getArticleId())->getTitle();	
					$array['articleId'] = $value->getArticleId();			
					$array['idParent'] = $value->getIdParent();
					//On ajoute le tout dans un tableau qu'on renvoie dans la vue
					$data[] = $array;
				}
				$array = [];
				foreach ($data as $comment => $test) {
					$array[$data[$comment]['id']] = $data[$comment];
					
				}
				$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
				return $this->response->setBody($html);
			}
		}

		//effacer un commentaire
		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$message = 'Commentaire introuvable';
			}else{
				$articleDelete = (new Comment)->delete($id);
				if ($articleDelete) {
					$message = 'Le commentaire n°' . $id . ' a bien été supprimé';
				}elseif (is_null($article)) {
					$html = 'Commentaire introuvable';
				}
				else{
					$html = 'Il y a eu une erreur d\'éxécution, veuillez vérifier vos paramètres.';
				}
			}
			$this->redirectInIndex($message);
		}
		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function saveAction(){
			$post = $this->request->getPost();
			$comment = new Comment($post);
			$newRecord = $comment->save($comment);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$message = 'Les modifications ont bien été effectuées';
				}else{
					$message = 'Le commentaire a bien été ajouté';
				}
			}else{
				$message = 'Une erreur est survenue durant l\'enregistrement';
			}
			$path ='?interface=admin&controller=' . $this->controller . '&action=display&id=' . $comment->getArticleId();
			$this->response->redirectUrl($this->app->getUrl($path));
		}

		// http://localhost?controller=article&action=show&id=3
		//display one article 
		public function showAction(){
			$id = (int)$this->request->getParam('id');
			if (is_null($id) OR !isset($id)) {
				$message = "Article introuvable";
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
					$message = "Article introuvable";
				}
			}
			//on return le $html
			
			$this->redirectInIndex($message);
		}
	}



?>
