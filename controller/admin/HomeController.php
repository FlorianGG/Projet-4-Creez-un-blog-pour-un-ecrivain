<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Article;
	use model\http\Request;
	use model\http\Response;
	use view\View;

	class HomeController extends BackEndController{

		public function __construct(Request $request, Response $response){
			parent::__construct($request, $response);
			parent::checkLogged();
		}

		public function indexAction(){
			$html = (new View($this->action, $this->controller, $this->interface))->generate();
			return $this->response->setBody($html);
		}
	}
