<?php
	namespace model;

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
			$passhash = password_verify($pass, $person->getPass());
			if(!is_null($person) && $passhash === true){
				$_SESSION[$this->personId] = $person->getId();
				return true;
			}
		} 

		public function logged(){
			return isset($_SESSION[$this->personId]) && !is_null($_SESSION[$this->personId]);
		}

	}
