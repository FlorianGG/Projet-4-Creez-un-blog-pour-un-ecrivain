<?php
	namespace model;

	use model\manager\UserManager;
	

	class User extends ModelPersonAbstract{
		protected $id;
		protected $pseudo;
		protected $email;
		protected $pass;

		//fonction constructeur
		public function __construct(array $data = null){
			$this->hydrate($data);
			$this->manager = new UserManager;
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
?>
