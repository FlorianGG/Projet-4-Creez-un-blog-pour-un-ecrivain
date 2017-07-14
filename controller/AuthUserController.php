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
			$post = $this->request->getPost();
			if($this->authUser->login($pseudo, $pass)){
				$this->app->addSuccessMessage('Authentification réussie');
				setcookie('pseudo','');
				if (isset($post['remember'])) {
					setcookie('pseudo', $post['pseudo'], time() + 7*24*3600, null, null, false, true);
				}
				$path = '?controller=home&action=index';
				$url = $this->app->getUrl($path);
				$code = 200;
				$this->response->redirectUrl($url, $code);
			}else{
				$this->app->addErrorMessage('Pseudo et/ou mot de passe non reconnu');
				$path = '?controller=authUser&action=auth';
				$url = $this->app->getUrl($path);
				$code = 401;
				$this->response->redirectUrl($url, $code);
			}
		}

		public function logoutAction(){
			$_SESSION['userId'] = null;
			$_SESSION['pseudo'] = null;
			$this->app->addSuccessMessage('Vous avez bien été déconnecté');
			$path = '?controller=home&action=index';
			$url = $this->app->getUrl($path);
			$code = 200;
			$this->response->redirectUrl($url, $code);
		}


	}
