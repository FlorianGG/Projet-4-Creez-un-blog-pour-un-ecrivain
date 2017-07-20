<?php
	namespace OCProjet4\model;

	abstract class AuthAbstract
	{
		protected $bdd;
		protected $person;
		protected $personId;

		//function constructeur
		public function __construct(){
			$this->bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
		}

		public function login($pseudo, $pass){
			$person = $this->person->readByPseudo($pseudo);
			if(!is_null($person)){
				$passhash = password_verify($pass, $person->getPass());
				if ($passhash === true) {
					$_SESSION[$this->personId] = $person->getId();
					$_SESSION['pseudo'] = $person->getPseudo();
					return true;
				}	
			}
			return false;
		} 

		public function logged(){
			return isset($_SESSION[$this->personId]) && !is_null($_SESSION[$this->personId]);
		}

	}
