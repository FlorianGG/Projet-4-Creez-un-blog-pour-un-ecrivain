<?php 
	namespace OCProjet4\controller\admin;

	use OCProjet4\controller\BackEndController;
	use OCProjet4\model\Article;
	use OCProjet4\model\Comment;
	use OCProjet4\model\User;
	use OCProjet4\model\Admin;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;
	use OCProjet4\helper\VisitCount;
	use OCProjet4\helper\Image;

	class HomeController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		public function indexAction(){
			$data = [];
			$data = array(
				'nbVisitor' => (new VisitCount)->getNb(),
				'nbArticle' => (new Article)->count(),
				'nbUser' => (new User)->count(),
				'nbComment' => (new Comment)->count(),
				'nbAdmin'	=> (new Admin)->count(),
				'admin' => $this->bringBackAdmin()
			);
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		public function validateImgAction(){
			$name = $this->request->getParam('name');
			(new Image)->validateImg($name);
		}

		private function bringBackAdmin(){
			$admins = (new Admin)->readAll();
			$array = [];

			foreach ($admins as $key => $value) {
				$admin = array(
					'id' => $admins[$key]->getId(),
					'pseudo' => $admins[$key]->getPseudo(),
					'email' => $admins[$key]->getEmail(),
					'pass' => $admins[$key]->getPass()
					);
				$array[] = $admin;
			}
			return $array;
		}

		public function deleteUserAction(){

			if (!is_null((new User)->readByPseudo($this->request->getPost()['pseudo']))) {
				$userId= (int)(new User)->readByPseudo($this->request->getPost()['pseudo'])->getId();
				if ($userId === $_SESSION['userId']) {
					$_SESSION['userId'] = null;
				}
				(new user)->delete($userId);
				$this->app->addSuccessMessage('L\'utilisateur a bien été supprimé');
				$code = 200;
				$path ='?interface=admin&controller=home&action=index';
			}else{
				$this->app->addErrorMessage('Aucun utilisateur trouvé avec ce pseudo');
				$code = 404;
				$path ='?interface=admin&controller=home&action=index';
			}
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}
