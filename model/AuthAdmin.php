<?php
	namespace model;

	class AuthAdmin{
		protected $bdd;
		protected $tableName;
		protected $admin;

		//function constructeur
		public function __construct(){
			$this->bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
			$this->admin = new Admin;
		}

		public function login($pseudo, $pass){
			$admin = $this->admin->readByPseudo($pseudo);
			if(!is_null($admin) && $pass = $admin->getPass()){
				return true;
			}else{
				return 'Le nom d\'utilisateur et/ou le mot de passe ne sont pas valides';
			}
		}

		public function logged(){
			return isset($_SESSION['pseudo']) && isset($_SESSION['pass']);
		}


	}
