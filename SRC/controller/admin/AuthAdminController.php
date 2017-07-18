<?php 
	namespace SRC\controller\admin;

	use SRC\controller\BackEndController;
	use SRC\model\AuthAdmin;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\view\View;
	use SRC\app\App;

	class AuthAdminController extends BackEndController{

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
			if($this->authAdmin->login($pseudo, $pass)){
				$this->app->addSuccessMessage('Authentification réussie');
				$code = 200;
				$path = '?interface=admin&controller=home&action=index';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url, $code);
			}else{
				$this->app->addErrorMessage('Pseudo et/ou mot de passe non reconnu');
				$code = 401;
				$path = '?interface=admin&controller=authAdmin&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url, $code);
			}
		}

		public function logoutAction(){
			$_SESSION['userId'] = null;
			$_SESSION['pseudo'] = null;
			$_SESSION['adminId'] = null;
			$code = 200;
			$this->app->addSuccessMessage('Vous avez bien été déconnecté');
			$path = '?interface=admin&controller=authAdmin&action=auth';
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url, $code);
		}


	}
