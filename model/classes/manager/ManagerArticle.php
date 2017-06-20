<?php 

	class ManagerArticle extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->_tableName = 'Article';
		}

	}


?>

