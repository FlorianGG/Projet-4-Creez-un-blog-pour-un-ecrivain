<?php 
	class Article{
		protected $_id;
		protected $_title;
		protected $_content;
		protected $_userId;
		protected $_dateArticle;

		public function __construct(array $data){
			//la fonction constructeur lance la fct hydrate qui assigne les valeurs de datas à chaque attribut de l'objet
			$this->hydrate($data);
		}

		public function hydrate(array $data){

			//pour chaque ligne du tableau
			foreach ($data as $key => $value) {
				//on crée la fonction set'$Key', function setter de la classe Article
				$method = 'set' . ucfirst($key);

				//si cette méthode existe on l'utilise avec la valeur contenu dans le tableau
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		//fonction getters
		public function getId(){
			return $this->_id;
		}

		public function getTitle(){
			return $this->_title;
		}

		public function getContent(){
			return $this->_content;
		}

		public function getUserId(){
			return $this->_userId;
		}

		public function getDateArticle(){
			return $this->_dateArticle;
		}

		//fonction setters
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->_id = $id;
			}
			
		}

		public function setTitle($title){
			if (is_string($title) && strlen($title) <= 70) {
				$this->_title = $title;
			}
			
		}

		public function setContent($content){
			if (is_string($content)) {
				$this->_content = $content;
			}
			
		}

		public function setUserId($userId){
			$userId = (int)$userId;
			if ($userId > 0) {
				$this->_userId = $userId;
			}
		}

		public function setDateArticle($dateArticle){
			$this->_dateArticle = $dateArticle;
		}


	}


?>
