<?php
	namespace model;

	use model\manager\ArticleManager;
	 
	class Article extends ModelAbstract{
		protected $_id;
		protected $_title;
		protected $_content;
		protected $_adminId;
		protected $_dateArticle;

		public function __construct(array $data = null){
			//la fonction constructeur lance la fct hydrate qui assigne les valeurs de datas à chaque attribut de l'objet
			$this->hydrate($data);
			$this->manager = new ArticleManager;
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
			return $this;
			
		}

		public function setTitle($title){
			if (is_string($title) && strlen($title) <= 70) {
				$this->_title = $title;
			}
			return $this;
			
		}

		public function setContent($content){
			if (is_string($content)) {
				$this->_content = $content;
			}
			return $this;
			
		}

		public function setAdminId($adminId){
			$adminId = (int)$adminId;
			if ($adminId > 0) {
				$this->_adminId = $adminId;
			}
			return $this;
		}

		public function setDateArticle($dateArticle){
			$this->_dateArticle = $dateArticle;
			return $this;
		}


	}


?>
