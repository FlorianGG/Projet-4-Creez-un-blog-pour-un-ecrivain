<?php
	namespace model;

	class Auth{
		protected $bdd;
		protected $admin;
		protected $id;

		//function constructeur
		public function __construct(){
			$this->bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
			$this->admin = new Admin;
		}

		public function login($pseudo, $pass){
			$prefixeSha1 = ModelPersonAbstract::PREFIXE_SHA1;
			$pass = sha1($prefixeSha1.$pass);
			$admin = $this->admin->readByPseudo($pseudo);
			if(!is_null($admin) && $pass === $admin->getPass()){
				$_SESSION['id'] = $admin->getId();
				$this->id = $_SESSION['id'];
				return true;
			}
		} 

		public function logged(){
			return isset($_SESSION['id']);
		}


	}
