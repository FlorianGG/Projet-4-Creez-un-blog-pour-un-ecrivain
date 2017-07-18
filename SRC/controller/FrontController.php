<?php 
	namespace SRC\controller;

	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\AuthUser;
	use SRC\app\App;

	class FrontController extends BaseController{
		protected $interface;
		protected $authUser;

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			$this->interface = 'front';
			$this->authUser = new AuthUser;		
		}

		public function checkLogged(){
			if (!$this->authUser->logged()) {
				$path = '?controller=home&action=index';
				$url = $this->app->getUrl($path);
				$code = 401;
				$this->response->redirectUrl($url, $code);
			}
		}
	}

?>