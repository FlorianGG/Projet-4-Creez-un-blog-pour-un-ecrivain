<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Article;
	use model\http\Request;
	use model\http\Response;
	use view\View;

	class ArticleController extends BackEndController{

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
			$html = (new View($this->action, $this->controller, $this->interface))->generate($data);
			return $this->response->setBody($html);
		}


		// http://localhost?controller=backend&action=delete&id=3
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
		// http://localhost?controller=backend&action=addArticle
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
