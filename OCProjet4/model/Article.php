<?php
	namespace OCProjet4\model;

	use OCProjet4\model\manager\ArticleManager;
	 
	class Article extends ModelAbstract{
		protected $id;
		protected $title;
		protected $content;
		protected $adminId;
		protected $dateArticle;
		protected $isDraft;

		public function __construct(array $data = null){
			//la fonction constructeur lance la fct hydrate qui assigne les valeurs de datas à chaque attribut de l'objet
			$this->hydrate($data);
			$this->manager = new ArticleManager;
		}

		//function previousId qui fait appel au manager et sa fonction previousId
		public function previousId(int $id){
			return $this->manager->previousId($id);
		}

		//function nextId qui fait appel au manager et sa fonction nextId
		public function nextId(int $id){
			return $this->manager->nextId($id);
		}

		//fonction getters
		public function getTitle(){
			return $this->title;
		}

		public function getContent(){
			return $this->content;
		}

		public function getAdminId(){
			return $this->adminId;
		}

		public function getDateArticle(){
			$date = new \DateTime($this->dateArticle);
			return $date->format('d-m-Y à H:i');
		}

		public function getIsDraft(){
			return $this->isDraft;
		}

		//fonction setters
		public function setTitle($title){
			if (is_string($title) && strlen($title) <= 70) {
				$this->title = $title;
			}
			return $this;
			
		}

		public function setContent($content){
			$content = htmlspecialchars_decode($content);
			if (is_string($content)) {
				$this->content = $content;
			}
			return $this;
			
		}

		public function setAdminId($adminId){
			$adminId = (int)$adminId;
			if ($adminId > 0) {
				$this->adminId = $adminId;
			}
			return $this;
		}

		public function setDateArticle($dateArticle){
			$this->dateArticle = $dateArticle;
			return $this;
		}

		public function setIsDraft($isDraft){
			$this->isDraft = $isDraft;
			return $this;
		}


	}


?>
