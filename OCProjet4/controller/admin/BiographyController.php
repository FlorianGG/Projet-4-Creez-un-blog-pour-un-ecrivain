<?php 
	namespace OCProjet4\controller\admin;

	use OCProjet4\controller\BackEndController;
	use OCProjet4\model\Biography;
	use OCProjet4\model\http\Request;
	use OCProjet4\model\http\Response;
	use OCProjet4\view\View;
	use OCProjet4\app\App;

	class BiographyController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		//function qui va récupérer le contenu de la Biography et la renvoyer dans la vue
		public function setAction(){
			$data = [];
			$data[] = (new Biography)->getContent();
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		// fonction qui enregistre une nouvelle biography
		// et renvoie un message selon le résultat de l'action sur la même page
		public function postAction(){
			$data = $this->request->getPost();
			$biography = (new Biography)->setContent($data['content']);
			if ($biography) {
				$code = 200;
				$this->app->addSuccessMessage('La biographie a bien été modifiée');
			}else{
				$code = 404;
				$this->app->addErrorMessage('Une erreur est survenue');
			}
			$path ='?interface=admin&controller=biography&action=set';
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}
	}



?>
