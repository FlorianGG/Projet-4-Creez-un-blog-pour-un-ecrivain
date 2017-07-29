<?php 
	namespace OCProjet4\controller\admin;

	use OCProjet4\controller\BackEndController;
	use OCProjet4\model\AuthAdmin;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;

	class AuthAdminController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		//function qui retourne la vue du formulaire de connection pour un admin
		public function authAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		//function qui va renvoyer un message et une vue spécifique
		//selon la réponse de la fonction login de l'objet AuthAdmin
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

		// function décoonect un admin en réinitiallisant les varibles SESSION
		// On renvoie sur la page d'authentification admin
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
