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
