<?php 
	namespace OCProjet4\controller;

	use OCProjet4\controller\FrontController;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\model\User;
	use OCProjet4\view\View;
	use OCProjet4\app\App;

	class UserController extends FrontController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
		}

		// fonction qui lance la vue pour l'inscription d'un user
		public function registrationAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}

		// fonction qui crée ou modifie un user
		// on verifie d'abbord que les mdp envoyés sont bien identiques
		public function saveAction(){
			$post = $this->request->getPost();
			if($post['pass2'] !== $post['pass']){
				$this->app->addErrorMessage('Les deux mots de passe ne sont pas identiques');
				$path ='?controller=user&action=registration';
				$code = 401;
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
			// on vérifie le contenu de $post : longueur des contenus et format email
			if($this->request->checkForm($post)){
				$user = new User($post);
				if($user->checkIfExist($user)){
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
				}else{
					//on renvoie un message d'erreur si pseudo ou email deja utilisé
					$this->app->addErrorMessage('Le pseudo ou le mail sont déjà utilisés');
					$code = 200;
					$path ='?controller=user&action=registration';
					$this->response->redirectUrl($this->app->getUrl($path), $code);
				}
			}else{
				$this->app->addErrorMessage('Un des champs ne respecte pas la mise en forme demandée : Entre 3 et 16 caractères sans espace ou email non valide');
				$code = 200;
				$path ='?controller=user&action=registration';
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}

		}

	}
