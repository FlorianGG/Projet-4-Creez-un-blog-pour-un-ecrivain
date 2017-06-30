<?php
	namespace model;

	class ModelPersonAbstract extends ModelAbstract{

		const PREFIXE_SHA1 = 'fl0ri@n';

		//fonction qui instancie un managerUser et retourn un objet User correspondant à l'email recherché
		public function readByEmail($email){
			return $this->manager->readByEmail($email);
		}

		//fonction qui instancie un managerUser et retourn un objet User correspondant au pseudo recherché
		public function readByPseudo($pseudo){
			return $this->manager->readByPseudo($pseudo);
		}

		//fonctions getters
		public function getId(){
			return $this->id;
		}
		public function getPseudo(){
			return $this->pseudo;
		}
		public function getEmail(){
			return $this->email;
		}		
		public function getPass(){
			return $this->pass;
		}

		//fonctions setters
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->id = $id;
			}
			return $this;
		}
		public function setPseudo($pseudo){
			if (is_string($pseudo) && (strlen($pseudo) <= 70)) {
				$this->pseudo = $pseudo;
			}
			return $this;
		}

		//ajout d'une regex pour vérifier la conformité de l'adresse mail
		public function setEmail($email){
			if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
				$this->email = $email;
			}
			return $this;
		}
		public function setPass($pass){
			$this->pass = $pass;
			return $this;
		}	
	}
