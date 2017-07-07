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
			return $data;
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
