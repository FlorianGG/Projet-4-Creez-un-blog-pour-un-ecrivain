<?php 
	namespace SRC\controller\admin;

	use SRC\controller\BackEndController;
	use SRC\model\Article;
	use SRC\model\Comment;
	use SRC\model\User;
	use SRC\model\Admin;
	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\view\View;
	use SRC\app\App;
	use SRC\helper\VisitCount;
	use SRC\helper\Image;

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
				'nbAdmin'	=> (new Admin)->count()
			);
			$html = (new View($this->action, $this->controller, $this->interface, $this->app))->generate($data);
			return $this->response->setBody($html);
		}

		public function validateImgAction(){
			$name = $this->request->getParam('name');
			(new Image)->validateImg($name);
		}
	}
