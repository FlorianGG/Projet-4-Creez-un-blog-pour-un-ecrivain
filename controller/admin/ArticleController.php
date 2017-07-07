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
				$data['article'][] = $array;
			}

			$data['comment'] = (new CommentController($this->request, $this->response, $this->app))->indexAction();

			$html = (new View($this->action, $this->controller, $this->interface))->generate($data);
			return $this->response->setBody($html);
		}

		// http://localhost?controller=backend&action=delete&id=3
		//effacer un article
		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$message = 'Article introuvable';
			}else{
				$articleDelete = (new Article)->delete($id);
				if ($articleDelete) {
					$message = 'L\'article n°' . $id . ' a bien été supprimé';
				}elseif (is_null($article)) {
					$html = 'Article introuvable';
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
			$article = new Article($post);
			$newRecord = $article->save($article);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$message = 'Les modifications ont bien été effectuées';
				}else{
					$message = 'L\'article a bien été ajouté';
				}
			}else{
				$message = 'Une erreur est survenue durant l\'enregistrement';
			}
			$this->redirectInIndex($message);
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
					$html = (new View($this->action, $this->controller, $this->interface))->generate($data);
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
