<?php 
	namespace OCProjet4\controller;

	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\Article;
	use OCProjet4\model\Admin;
	use OCProjet4\model\Biography;
	use OCProjet4\view\View;	
	
	class HomeController extends FrontController{
		//Récupère les 3 derniers articles publiables
		public function indexAction(){
			$html = "";
			$article = (new Article)->readAll();
			$data = [];
			$articles = [];
			//on nettoie le résultat des articles 'brouillon'
			foreach ($article as $key => $value) {
				if (!is_null($article[$key]->getIsDraft())) {
					unset($article[$key]);
				}
			}
			foreach ($article as $tour => $val) {
				$articles [] = $article[$tour];
			}
			//on boucle sur le résultat nettoyée
			if (sizeof($articles)>=3) {
				$size = sizeof($articles)-3;
			}else{
				$size = 0;
			}
			for ($i=sizeof($articles)-1; $i >= $size; $i--) { 
				
				$array = [];
				$array['id'] = $articles[$i]->getId();
				$array['title'] = $articles[$i]->getTitle();
				$array['content'] = $articles[$i]->getContent();
				$array['dateArticle'] = $articles[$i]->getDateArticle();
				$array['adminPseudo'] = (new Admin)->read($articles[$i]->getAdminId())->getPseudo();
				$array['isDraft'] = $articles[$i]->getIsDraft();

				$data['articles'][] = $array;
				
			}
			// on récupère le contenu de la biographie
			$data['biography'] = (new Biography)->getContent();

			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}
	}
