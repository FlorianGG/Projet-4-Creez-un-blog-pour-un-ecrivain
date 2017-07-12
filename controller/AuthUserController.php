<?php 
	namespace controller;

	use controller\FrontController;
	use model\AuthUser;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

	class AuthUserController extends FrontController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		public function authAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		public function loginAction(){
			$pseudo = $this->request->getPost()['pseudo'];
			$pass = $this->request->getPost()['pass'];
			if($this->authUser->login($pseudo, $pass)){
				$this->app->addSuccessMessage('Authentification réussie');
				$path = '?controller=home&action=index';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}else{
				$this->app->addErrorMessage('Pseudo et/ou mot de passe non reconnu');
				$path = '?controller=authUser&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}
		}

		public function logoutAction(){
			$this->app->addSuccessMessage('Vous avez bien été déconnecté');
			session_destroy();
			$path = '?controller=home&action=index';
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url);
		}


	}
