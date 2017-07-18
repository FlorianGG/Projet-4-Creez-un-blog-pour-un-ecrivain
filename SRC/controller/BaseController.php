<?php
	namespace SRC\controller;

	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\Article;
	use SRC\view\View;
	use SRC\app\App;
	

	 
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
