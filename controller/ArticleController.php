<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use model\Admin;
	use view\View;	
	
	class ArticleController extends FrontController{

		private function redirectAtHome($message){
			$url ='http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/?&controller=home&action=index&message=' . $message;
			$this->response->redirectUrl($url);
		}

		//list all articles
		public function indexAction(){
			$html = "";
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

				$data[] = $array;
			}
			$html = (new View($this->action, $this->controller))->generate($data);
			return $this->response->setBody($html);
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
			
			$this->redirectAtHome($message);
		}

		
	}
?>
