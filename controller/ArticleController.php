<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	
	
	class ArticleController extends FrontController{
		protected $request;
		protected $response;
		// http://localhost?controller=article&action=index

		public function __construct(Request $request, Response $response){
			$this->request = $request;
			$this->response = $response;
		}

		//list all articles
		public function indexAction(){
			$html = "";
			$articles = (new Article)->readAll();

			foreach ($articles as $key => $value) {
				$html .= '<h2>' . $value->getTitle() . '</h2>';
				$html .= '<p>' . $value->getContent() . '</p>';
				$html .= '<p><em> Crée le : ' . $value->getDateArticle() . '</em></p>';

			}
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
					$html = "";
					$html .= '<h2>' . $article->getTitle() . '</h2>';
					$html .= '<p>' . $article->getContent() . '</p>';
					$html .= '<p><em> Crée le : ' . $article->getDateArticle() . '</em></p>';

				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					$html = "<h2>Article introuvable </h2>";
				}
			}
			//on return le $html
			return $this->response->setBody($html);
		}

		// http://localhost?controller=article&action=delete&id=3

		//effacer un article

		public function deleteAction(){
			$id = (int) $this->request->getParam('id');
			if (is_null($id) OR !isset($id) OR $id === 0) {
				$html = "<h2>Article introuvable </h2>";
			}else{
				$article = (new Article)->delete($id);
				if ($article) {
					$html = "<h2>L'article n°" . $id . " a bien été supprimé</h2";
				}elseif (is_null($article)) {
					$html = "<h2>Article introuvable</h2>";
				}
				else{
					$html = "Il y a eu une erreur d'éxécution, veuillez vérifier vos paramètres.";
				}
			}
			//on return le $html
			return $this->response->setBody($html);
		}

		// http://localhost?controller=article&action=addArticle

		//ajouter un article

		public function addArticleAction(){
			$post = $this->request->getPost();
			$article = new Article($post);

			$newRecord = $article->save($article);

			if ($newRecord) {
				$html = 'L\'article a bien été ajouté';
			}else{
				$html = 'Une erreur est survenue';
			}

			//on return le $html 			
			return $this->response->setBody($html);

		}
	}
?>
