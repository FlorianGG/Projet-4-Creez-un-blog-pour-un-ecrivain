<?php
	namespace model\classes;


	use model\classes\manager\ManagerArticle;

	 
	class Article extends ModelAbstract{
		protected $_id;
		protected $_title;
		protected $_content;
		protected $_adminId;
		protected $_dateArticle;

		public function __construct(array $data){
			//la fonction constructeur lance la fct hydrate qui assigne les valeurs de datas à chaque attribut de l'objet
			$this->hydrate($data);
			$this->manager = new ManagerArticle;
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

		//fonction chargée de récupérer tous les attributs et de les retourner dans un tableau. Le but étant de ne pas passer les attributs en public
		public function returnData(){
			$data = [];
			foreach ($this as $key => $value) {
				$data[$key] = $value;
			}
			return $data;
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

		public function getAdminId(){
			return $this->_adminId;
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

		public function setAdminId($adminId){
			$adminId = (int)$adminId;
			if ($adminId > 0) {
				$this->_adminId = $adminId;
			}
		}

		public function setDateArticle($dateArticle){
			$this->_dateArticle = $dateArticle;
		}


	}


?>
