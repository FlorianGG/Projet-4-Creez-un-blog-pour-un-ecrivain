<?php 
	namespace controller\admin;

	use controller\BackEndController;
	use model\Article;
	use model\Comment;
	use model\User;
	use model\Admin;
	use model\http\Request;
	use model\http\Response;
	use view\View;
	use app\App;
	use helper\VisitCount;
	use helper\Image;

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
