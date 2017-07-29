<?php
	namespace OCProjet4\controller;

	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\Article;
	use OCProjet4\view\View;
	use OCProjet4\app\App;
	

	 
	abstract class BaseController{
		protected $request;
		protected $response;
		protected $action;
		protected $controller;
		protected $pseudo;
		protected $app;
		
		// constructeur qui set les variabes action et controller
		// ces variables permettent de définir quelle vue utiliser
		public function __construct(Request $request, Response $response, App $app){
			$this->request = $request;
			$this->response = $response;
			$this->action = $this->request->getParam('action');
			$this->controller = $this->request->getParam('controller');
			$this->app = $app;

		}
	}

?>
