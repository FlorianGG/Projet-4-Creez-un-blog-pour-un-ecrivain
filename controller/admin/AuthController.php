<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Auth;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

	class AuthController extends BackEndController{
		protected $auth;

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		public function authAction(){
			$html = (new View($this->action, $this->controller, $this->interface))->generate();
			return $this->response->setBody($html);
		}

		public function loginAction(){
			$pseudo = $this->request->getPost()['pseudo'];
			$pass = $this->request->getPost()['pass'];
			if($this->auth->login($pseudo, $pass)){
				$path = '?interface=admin&controller=home&action=index';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}else{
				$path = '?interface=admin&controller=auth&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}
		}

		public function logoutAction(){
			session_destroy();
			$path = '?interface=admin&controller=auth&action=auth';
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url);
		}


	}
