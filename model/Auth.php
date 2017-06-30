<?php
	namespace model;

	class Auth{
		protected $bdd;
		protected $admin;
		protected $pseudo;
		protected $pass;

		//function constructeur
		public function __construct(){
			$this->bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
			$this->admin = new Admin;
			if ($this->logged()) {
				$this->pseudo = $_SESSION['pseudo'];
				$this->pass = $_SESSION['pass'];

			}

		}

		public function login($pseudo, $pass){
			$prefixeSha1 = ModelPersonAbstract::PREFIXE_SHA1;
			$pass = sha1($prefixeSha1.$pass);
			$admin = $this->admin->readByPseudo($pseudo);
			if(!is_null($admin) && $pass === $admin->getPass()){
				return true;
			}else{
				return (new Response)->redirect('403', 'Forbidden');
			}
		} 

		public function logged(){
			return isset($_SESSION['pseudo']) && isset($_SESSION['pass']);
		}


	}
