<?php 
	namespace OCProjet4\controller;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\AuthAdmin;
	use OCProjet4\app\App;

	
	
	class BackEndController extends BaseController{
		protected $interface;
		protected $authAdmin;

		// constructeur de la partie backend
		// on initialise la variable interface sur Admin
		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			$this->interface = $this->request->getParam('interface');
			$this->authAdmin = new AuthAdmin;		
		}

		// fonction qui vérifie si l'admin est loggé pour accéder aux fonctionnalités 
		public function checkLogged(){
			if (!$this->authAdmin->logged()) {
				$this->app->addErrorMessage('Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous identifier');
				$path = '?interface=admin&controller=authAdmin&action=auth';
				$code = 401;
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
		}
	}
