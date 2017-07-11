<?php 
	namespace controller;

	use controller\FrontController;
	use model\http\Request;
	use model\http\Response;
	use model\User;
	use view\View;
	use app\App;

	class UserController extends FrontController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		public function registrationAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		public function saveAction(){
			$post = $this->request->getPost();
			$user = new User($post);
			$newRecord = $user->save($user);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$message = 'Les modifications ont bien été effectuées';
				}else{
					$message = 'L\'utilisateur a bien été ajouté';
					if ($post['remember']) {
						setcookie('pseudo', $post['pseudo'], time() + 7*24*3600, null, null, false, true);
					}
					$this->loginAction();
				}
			}else{
				$message = 'Une erreur est survenue durant l\'enregistrement';
			}
			$this->redirectInIndex($message);
		}

		public function loginAction(){
			$pseudo = $this->request->getPost()['pseudo'];
			$pass = $this->request->getPost()['pass'];
			if($this->authUser->login($pseudo, $pass)){
				$path = '?controller=home&action=index';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}else{
				$path = '?controller=authUser&action=auth';
				$url = $this->app->getUrl($path);
				$this->response->redirectUrl($url);
			}
		}

		public function logoutAction(){
			session_destroy();
			$path = '?controller=home&action=index';
			$url = $this->app->getUrl($path);
			$this->response->redirectUrl($url);
		}


	}
