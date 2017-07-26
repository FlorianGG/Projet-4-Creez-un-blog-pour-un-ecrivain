<?php
	namespace OCProjet4\model\manager; 
	

	class UserManager extends ManagerPersonAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->tableName = 'user';
		}
	}
?>
