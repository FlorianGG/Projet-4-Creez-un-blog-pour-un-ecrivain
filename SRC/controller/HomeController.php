<?php 
	namespace SRC\controller;

	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\Article;
	use SRC\model\Admin;
	use SRC\model\Biography;
	use SRC\view\View;	
	
	class HomeController extends FrontController{
		//list the 3 last articles
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
			$data['biography'] = (new Biography)->getContent();

			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}
	}
