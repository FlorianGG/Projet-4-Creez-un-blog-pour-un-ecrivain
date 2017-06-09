<?php 
	class User{
		protected $_id;
		protected $_name;
		protected $_email;
		protected $_pass;
		//fonction constructeur
		public function __construct(array $data){
			$this->hydrate($data);
		}
		//fonction d'hydration
		public function hydrate(array $date){
			foreach ($data as $key => $value) {
				$method = 'set' . ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
		//fonctions getters
		public function getId(){
			return $this->_id;
		}
		public function getName(){
			return $this->_name;
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
		public function setName($name){
			if (is_string($name) && (strlen($name) <= 70)) {
				$this->_name = $name;
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
