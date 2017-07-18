<?php 
	namespace SRC\controller;

	use SRC\controller\FrontController;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\User;
	use SRC\view\View;
	use SRC\app\App;

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
			if($post['pass2'] !== $post['pass']){
				$this->app->addErrorMessage('Les deux mots de passe ne sont pas identiques');
				$path ='?controller=user&action=registration';
				$code = 401;
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
			$user = new User($post);
			$newRecord = $user->save($user);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
					$code = 200;
				}else{
					$this->app->addSuccessMessage('L\'utilisateur a bien été ajouté');
					$code = 200;
					if (isset($post['remember'])) {
						setcookie('pseudo', $post['pseudo'], time() + 7*24*3600, null, null, false, true);
					}
					(new AuthUserController($this->request, $this->response, $this->app))->loginAction();
				}
			}else{
				$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
				$code = 404;
			}
			$path ='?controller=home&action=index';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}