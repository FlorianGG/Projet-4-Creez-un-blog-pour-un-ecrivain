<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Auth;
	use model\http\Request;
	use model\http\Response;
	use view\View;

	class AuthController extends BackEndController{
		protected $auth;

		public function __construct(Request $request, Response $response){
			parent::__construct($request, $response);
		}

		public function authAction(){
			$html = (new View($this->action, $this->controller, $this->interface))->generate();
			return $this->response->setBody($html);
		}

		public function loginAction(){
			$pseudo = $this->request->getPost()['pseudo'];
			$pass = $this->request->getPost()['pass'];
			if($this->auth->login($pseudo, $pass)){
				$url = 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/?interface=admin&controller=home&action=index';
				$this->response->redirectUrl($url);
			}else{
				$this->response->redirect('403', 'Forbidden');
			}
		}

		public function logoutAction(){
			session_destroy();
			$url = 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/?controller=article&action=index';
			$this->response->redirectUrl($url);
		}


	}
