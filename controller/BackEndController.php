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
				$this->app->addErrorMessage('Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous identifier');
				$path = '?interface=admin&controller=authAdmin&action=auth';
				$this->response->redirectUrl($this->app->getUrl($path));
			}
		}
	}
