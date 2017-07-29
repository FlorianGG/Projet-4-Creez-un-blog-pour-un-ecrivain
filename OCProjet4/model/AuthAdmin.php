<?php
	namespace OCProjet4\model;

	class AuthAdmin extends AuthAbstract
	{
		//function constructeur
		public function __construct(){
			parent::__construct();
			$this->person = new Admin;
			$this->personId = 'adminId';
		}

		// fonction login spécifique pour l'admin
		// car on crée également une connection user
		public function login($pseudo, $pass){
			$user = new User;
			$person = $this->person->readByPseudo($pseudo);
			$userAdmin = $user->readByPseudo($pseudo);
			if(!is_null($person)){
				$passAdmin = password_verify($pass, $person->getPass());
				if (!is_null($userAdmin)) {
					$passUser = password_verify($pass, $userAdmin->getPass());
				}
				if ($passAdmin === true) {
					$_SESSION[$this->personId] = $person->getId();
					if (!is_null($userAdmin) && $passUser === true) {
						$_SESSION['userId'] = $userAdmin->getId();
					}
					return true;
				}
			}
			return false;
		} 
	}
