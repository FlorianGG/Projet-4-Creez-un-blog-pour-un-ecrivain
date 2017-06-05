<?php 
	
	class ArticleController extends FrontController{

		// http://localhost?controller=article&action=index

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

		public function showAction(){
			$id =(int) $_GET['id'];
			$ManagerArticle = new ManagerArticle;
			$article = $mMnagerArticle->read($id);

			if (!is_null($article)){
				$html = "";

				$html .= '<h2>' . $article->getTitle() . '</h2>';
				$html .= '<p>' . $article->getContent() . '</p>';
				$html .= '<p><em> Crée le : ' . $article->getDateArticle() . '</em></p>';

				return $html;

			}else{
				return "<h2>Article introuvable</h2>";
			}
		}




	}


	

?>
