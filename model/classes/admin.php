<?php 
	class Admin{
		protected $_id;
		protected $_pseudo;
		protected $_email;
		protected $_pass;

		//fonction constructeur avec un tableau en paramètre
		public function __construct(array $data){
			$this->hydrate($data);
		}

		//function hydrate qui hydrate les attributs grâce au tableau en paramètre

		public function hydrate(array $data){
			//on parcourt le tableau pour créer nos fonctions setters
			foreach ($data as $key => $value) {
				$method = 'set' . ucfirst($key);
				//si elles existent on les execute
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		//fonctions getters
		public function getId(){
			return $this->_id;
		}
		public function getPseudo(){
			return $this->_pseudo;
		}
		public function getEmail(){
			return $this->_email;
		}		
		public function getPass(){
			return $this->_pass;
		}

		//fonctions setters
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->_id = $id;
			}
		}
		public function setPseudo($pseudo){
			if (is_string($pseudo) && (strlen($pseudo) <= 70)) {
				$this->_pseudo = $pseudo;
			}
		}

		//ajout d'une regex pour vérifier la conformité de l'adresse mail
		public function setEmail($email){
			if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
				$this->_email = $email;
			}
		}
		public function setPass($pass){
			$this->_pass = $pass;
		}
	}
?>
