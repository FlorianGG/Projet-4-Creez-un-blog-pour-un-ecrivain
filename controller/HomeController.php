<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use model\Admin;
	use model\Biography;
	use view\View;	
	
	class HomeController extends FrontController{
		//list the 3 last articles
		public function indexAction(){
			$html = "";
			$articles = (new Article)->readAll();
			$data = [];
			for ($i=sizeof($articles)-1; $i >= sizeof($articles)-3; $i--) { 
				$array = [];
				$array['id'] = $articles[$i]->getId();
				$array['title'] = $articles[$i]->getTitle();
				$array['content'] = $articles[$i]->getContent();
				$array['dateArticle'] = $articles[$i]->getDateArticle();
				$array['adminPseudo'] = (new Admin)->read($articles[$i]->getAdminId())->getPseudo();

				$data['articles'][] = $array;
			}
			$data['biography'] = (new Biography)->getContent();

			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}
	}
