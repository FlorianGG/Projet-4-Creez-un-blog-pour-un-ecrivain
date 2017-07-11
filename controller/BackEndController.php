<?php 
	namespace controller;
	use model\http\Request;
	use model\http\Response;
	use model\AuthAdmin;
	use app\App;

	
	
	class BackEndController extends BaseController{
		protected $interface;
		protected $authAdmin;

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			$this->interface = $this->request->getParam('interface');
			$this->authAdmin = new AuthAdmin;		
		}

		public function checkLogged(){
			if (!$this->authAdmin->logged()) {
				$path = '?interface=admin&controller=authAdmin&action=auth';
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
