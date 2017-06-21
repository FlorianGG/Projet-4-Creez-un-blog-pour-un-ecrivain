<?php
	namespace Model\Classes\Manager; 
	

	class UserManager extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->_tableName = 'User';
		}

		//fonction read qui permet de lire une ligne de la bdd en fonction de son email
		public function loadByEmail($email){
			//on prepare la requete filtré par l'email
			$req = $this->_bdd->prepare('SELECT * from user WHERE email=:email');

			//on bind le filtre avec la valeur de $email
			$req->bindValue(':email', $email, PDO::PARAM_STR);

			return $this->loadByQuery($req);
		}
	}
?>
