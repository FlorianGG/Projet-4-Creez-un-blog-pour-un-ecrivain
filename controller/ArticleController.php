<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use view\View;	
	
	class ArticleController extends FrontController{

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
				$array['date'] = $value->getDateArticle();

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
				$html = "<h2>Article introuvable </h2>";
			}else{
				$article = (new Article)->read($id);
				//si aucune erreur on affiche l'article selectionné
				if (!is_null($article)){
					//on insère les données dans un tableau pour les envoyer dans la vue
					$data = [
						'id' => $article->getId(),
						'title' => $article->getTitle(),
						'content' => $article->getContent(),
						'date' => $article->getDateArticle()
						];
					//on définit l'action
					$html = (new View($this->action, $this->controller))->generate($data);

				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					$html = "<h2>Article introuvable </h2>";
				}
			}
			//on return le $html
			
			return $this->response->setBody($html);
		}

		
	}
?>
