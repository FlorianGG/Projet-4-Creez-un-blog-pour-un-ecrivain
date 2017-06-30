<?php 
	namespace controller;
	use model\http\Request;
	use model\http\Response;
	use model\AuthAdmin;
	use view\View;

	
	
	class BackEndController extends BaseController{
		protected $interface;

		public function __construct(Request $request, Response $response){
			parent::__construct($request, $response);
			$this->interface = $this->request->getParam('interface');
		}
	}
