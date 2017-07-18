<?php 
	namespace SRC\controller\admin;

	use SRC\controller\BackEndController;
	use SRC\model\Biography;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\view\View;
	use SRC\app\App;

	class BiographyController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		//list all articles
		public function setAction(){
			$data = [];
			$data[] = (new Biography)->getContent();
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

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
