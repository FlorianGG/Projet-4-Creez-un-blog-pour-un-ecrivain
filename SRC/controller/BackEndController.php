<?php 
	namespace SRC\controller;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\AuthAdmin;
	use SRC\app\App;

	
	
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
				$this->app->addErrorMessage('Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous identifier');
				$path = '?interface=admin&controller=authAdmin&action=auth';
				$code = 401;
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
		}
	}
