<?php
	namespace model;

	class ModelPersonAbstract extends ModelAbstract{
		//fonction qui instancie un managerUser et retourn un objet User correspondant à l'email recherché
		public function readByEmail($email){
			return $this->manager->readByEmail($email);
		}

		//fonction qui instancie un managerUser et retourn un objet User correspondant au pseudo recherché
		public function readByPseudo($pseudo){
			return $this->manager->readByPseudo($pseudo);
		}	
	}
