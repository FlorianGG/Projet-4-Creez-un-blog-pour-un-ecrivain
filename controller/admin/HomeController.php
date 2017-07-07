<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Article;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;

	class HomeController extends BackEndController{

		public function __construct(Request $request, Response $response, App $app){
			parent::__construct($request, $response, $app);
			parent::checkLogged();
		}

		public function indexAction(){
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate();
			return $this->response->setBody($html);
		}
	}
