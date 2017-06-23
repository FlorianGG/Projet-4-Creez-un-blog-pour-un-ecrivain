<?php
	namespace model\manager; 


	class ArticleManager extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			$this->_tableName = 'Article';
			parent::__construct();
			
		}

	}


?>

