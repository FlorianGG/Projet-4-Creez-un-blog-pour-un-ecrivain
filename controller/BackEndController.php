<?php 
	namespace controller;
	use model\http\Request;
	use model\http\Response;
	use model\Auth;

	
	
	class BackEndController extends BaseController{
		protected $interface;
		protected $auth;

		public function __construct(Request $request, Response $response){
			parent::__construct($request, $response);
			$this->interface = $this->request->getParam('interface');
			$this->auth = new Auth;		
		}

		public function checkLogged(){
			if (!$this->auth->logged()) {
				$url = 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/?interface=admin&controller=auth&action=auth';
				$this->response->redirectUrl($url);
			}
		}

	}
