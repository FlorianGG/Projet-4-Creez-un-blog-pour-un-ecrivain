<?php
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use view\View;
	use app\App;
	

	 
	abstract class BaseController{
		protected $request;
		protected $response;
		protected $action;
		protected $controller;
		protected $pseudo;
		protected $app;
		
		// http://localhost?controller=article&action=index
		public function __construct(Request $request, Response $response, App $app){
			$this->request = $request;
			$this->response = $response;
			$this->action = $this->request->getParam('action');
			$this->controller = $this->request->getParam('controller');
			$this->app = $app;

		}
	}

?>
