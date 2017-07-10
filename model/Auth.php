<?php
	namespace model;

	class Auth{
		protected $bdd;
		protected $admin;

		//function constructeur
		public function __construct(){
			$this->bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
			$this->admin = new Admin;
		}

		public function login($pseudo, $pass){
			$admin = $this->admin->readByPseudo($pseudo);
			$pass = password_verify($pass, $admin->getPass());
			if(!is_null($admin) && $pass === true){
				$_SESSION['id'] = $admin->getId();

				return true;
			}
		} 

		public function logged(){
			return isset($_SESSION['id']) && !is_null($_SESSION['id']);
		}

		public function ifNotLogged(){
			if (isset($_SESSION['id'])) {
				$disabled = '';
			}else{
				$disabled = 'disabled="disabled"';
			}
		}


	}
