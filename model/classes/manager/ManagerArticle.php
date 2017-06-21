<?php
	namespace model\classes\manager;  

	use model\classes\Article;

	class ManagerArticle extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			$this->_tableName = 'Article';
			parent::__construct();
			
		}

	}


?>

