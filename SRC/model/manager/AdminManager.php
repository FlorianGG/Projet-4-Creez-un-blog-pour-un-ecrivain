<?php
	namespace SRC\model\manager; 
	

	class AdminManager extends ManagerPersonAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->tableName = 'Admin';
		}

	}
?>
