<?php 
	namespace controller;
	use model\http\Request;
	use model\http\Response;
	use model\Auth;
	use app\App;

	
	
	class BackEndController extends BaseController{
		protected $interface;
		protected $auth;

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			$this->interface = $this->request->getParam('interface');
			$this->auth = new Auth;		
		}

		public function checkLogged(){
			if (!$this->auth->logged()) {
				$path = '?interface=admin&controller=auth&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}
		}

		protected function redirectInIndex($message){
			$path ='?interface=admin&controller=' . $this->controller . '&action=index&message=' . $message;
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url);
		}

	}
