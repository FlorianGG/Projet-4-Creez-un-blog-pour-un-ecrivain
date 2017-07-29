<?php 
	namespace OCProjet4\controller\admin;

	use OCProjet4\controller\BackEndController;
	use OCProjet4\controller\admin\CommentController;
	use OCProjet4\model\Admin;
	use OCProjet4\model\User;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;


	class AdminController extends BackEndController{ //on extend du backEndController
		//Le controller récuère celui du parent
		//avec en paramètre les objets request, repsonse et app
		//dés qu'on instancie le controller on verifie que l'admin est bien loggé
		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		//fonction qui renvoi un admin avec l'id dans l'url pour le modifier
		//si aucun id c'est qu'on va créer un admin donc on ne renvoie aucun contenu
		public function recordAction(){
			if (!is_null($this->request->getParam('id'))) {
				$id = $this->request->getParam('id');
				$admin = (new Admin)->read($id);

				$data = array(
					'id' => $admin->getId(),
					'pseudo' => $admin->getPseudo(),
					'email' => $admin->getEmail(),
					'pass' => $admin->getPass()
				);
				// vue si on va modifier un admin -> avec du contenu
				$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			}else{
				// vue si on crée un admin -> sans contenu
				$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			}

			// on retourne la vue via la class response
			return $this->response->setBody($html);
		}

		// fonction qui sauvegarde un nouvel et crée également un user en parallèle
		// si $post n'a pas d'id on crée un admin 
		// sinon la fonction save va modifier l'admin
		public function saveAction(){
			// on vérifie d'abord que le mot de pass et sa confirmation sont identiques
			$post = $this->request->getPost();
			if($post['pass2'] !== $post['pass']){
				$this->app->addErrorMessage('Les deux mots de passe ne sont pas identiques');
				$path ='?interface=admin&controller=admin&action=record';
				$code = 200;
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
			// si oui, on vérifier le contenu de $post : longueur des contenus et format email
			if($this->request->checkForm($post)){
				$admin = new Admin($post);
				$userAdmin = new User($post);
				//on vérifie que l'admin/user crées/modifiés n'existe pas déjà en bdd 
				if(!empty($post['id']) OR ($admin->checkIfExist($admin) && $userAdmin->checkIfExist($userAdmin))){
					$newRecord = $admin->save($admin);
					$newRecordUser = $userAdmin->save($userAdmin);
					if ($newRecord) {
						if (!empty($post['id'])) {
							$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
							$code = 200;
						}else{
							$this->app->addSuccessMessage('L\'administrateur et l\'utilisateur ont bien été ajoutés');
							$code = 200;
						}
					}else{
						$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
						$code = 404;
					}
					$path ='?interface=admin&controller=home&action=index';
					$this->response->redirectUrl($this->app->getUrl($path), $code);
				}else{
					//on renvoie un message d'erreur si pseudo ou email deja utilisé
					$this->app->addErrorMessage('Le pseudo ou le mail sont déjà utilisés');
					$code = 200;
					$path ='?interface=admin&controller=admin&action=record';
					$this->response->redirectUrl($this->app->getUrl($path), $code);
				}
			}else{
				$this->app->addErrorMessage('Un des champs ne respecte pas la mise en forme demandée : Entre 3 et 16 caractères sans espace ou email non valide');
				$code = 200;
				$path ='?interface=admin&controller=admin&action=record';
				$this->response->redirectUrl($this->app->getUrl($path), $code);
			}
		}
		//on utilise pas car pas de gestion des articles si l'admin qui l'a écrit est effacé
		// public function deleteAction(){
		// 	$adminId = $this->request->getParam('id');
		// 	$adminPseudo = (new Admin)->read($adminId)->getPseudo();
		// 	$userId= (int)(new User)->readByPseudo($adminPseudo)->getId();

		// 	if (!is_null($adminId)) {
		// 		(new Admin)->delete($adminId);
		// 		(new user)->delete($userId);
		// 		$this->app->addSuccessMessage('L\'administrateur et son utilisateur ont bien été supprimés');
		// 		$code = 200;
		// 		$path ='?interface=admin&controller=home&action=index';
		// 	}else{
		// 		$this->app->addErrorMessage('Aucun administrateur ou utilisateurt trouvé pour cet id');
		// 		$code = 404;
		// 		$path ='?interface=admin&controller=home&action=index';
		// 	}
		// 	$this->response->redirectUrl($this->app->getUrl($path), $code);
		// }
	}
