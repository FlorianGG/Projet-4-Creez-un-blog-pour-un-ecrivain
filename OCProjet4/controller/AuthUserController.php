<?php 
	namespace OCProjet4\controller;

	use OCProjet4\controller\FrontController;
	use OCProjet4\model\AuthUser;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;

	class AuthUserController extends FrontController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		// fonction qui renvoie la vue pour logger un user
		public function authAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		// fonction login qui execute la fonction login du model
		// crée un cookie si nécessaire
		// renvoie un message sur le statut de la confirmation
		// redirige sur la page
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

		// fonction pour se délogger
		// renvoie un message
		// réinitialise les var SESSIONS
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
