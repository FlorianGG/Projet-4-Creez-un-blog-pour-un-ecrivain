<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\AuthAdmin;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

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
				$path = '?interface=admin&controller=home&action=index';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}else{
				$this->app->addErrorMessage('Pseudo et/ou mot de passe non reconnu');
				$path = '?interface=admin&controller=authAdmin&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}
		}

		public function logoutAction(){
			session_destroy();
			$this->app->addSuccessMessage('Vous avez bien été déconnecté');
			$path = '?interface=admin&controller=authAdmin&action=auth';
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url);
		}


	}
