<?php 
	
	class ArticleController extends FrontController{
		protected $request;
		// http://localhost?controller=article&action=index

		public function __construct(Request $request){
			$this->request = $request->getParams();
		}

		//list all articles
		public function indexAction(){
			$html = "";
			$ManagerArticle = new ManagerArticle;
			$articles = $ManagerArticle->readAll();

			foreach ($articles as $key => $value) {
				$html .= '<h2>' . $value->getTitle() . '</h2>';
				$html .= '<p>' . $value->getContent() . '</p>';
				$html .= '<p><em> Crée le : ' . $value->getDateArticle() . '</em></p>';

			}
			return $html;
		}

		// http://localhost?controller=article&action=show&id=3

		//display one article 

		public function showAction($id){
				$ManagerArticle = new ManagerArticle;
				$article = $ManagerArticle->read($id);
				//si aucune erreur on affiche l'article selectionné
				if (!is_null($article)){
					$html = "";

					$html .= '<h2>' . $article->getTitle() . '</h2>';
					$html .= '<p>' . $article->getContent() . '</p>';
					$html .= '<p><em> Crée le : ' . $article->getDateArticle() . '</em></p>';

					return $html;
				//dans tous les cas d'erreur on affiche que l'article est introuvable
				}else{
					return "<h2>Article introuvable</h2>";
				}
		}

		// http://localhost?controller=article&action=delete&id=3

		//effacer un article

		public function deleteAction(){
			// on verifie que la variable GET id existe bien et on la convertie en entier 
			if (isset($_GET['id'])) {
				$id =(int) $_GET['id'];
				$ManagerArticle = new ManagerArticle;
				$article = $ManagerArticle->delete($id);
				//si aucune erreur on doit recevoir true
				if ($article) {
					$html = "<h2>L'article n°" . $id . " a bien été supprimé</h2";
					return $html;
				}else{
					$html = "Il y a eu une erreur d'éxécution, veuillez vérifier vos paramètres.";
					return $html;
				}
			}else{
				$html = "Il y a eu une erreur d'éxécution, veuillez vérifier vos paramètres.";
				return $html;
			}

		}
	}
?>
