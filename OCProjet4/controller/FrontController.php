<?php 
	namespace OCProjet4\controller;

	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\AuthUser;
	use OCProjet4\app\App;

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
