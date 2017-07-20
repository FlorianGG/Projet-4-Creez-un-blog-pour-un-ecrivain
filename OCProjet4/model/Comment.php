<?php 
	namespace OCProjet4\model;

	use OCProjet4\model\manager\CommentManager;

	
	class Comment extends ModelAbstract{
		protected $id;
		protected $content;
		protected $userId;
		protected $dateComment;
		protected $articleId;
		protected $idParent;
		
		//fonction constructeur avec un tableau en paramètre
		public function __construct(array $data = null){
			$this->hydrate($data);
			$this->manager = new CommentManager;
		}

		//function readAllWithArticle qui fait appel au manager et sa fonction readAllWithArticle
		public function readAllWithArticle(int $id){
			return $this->manager->readAllWithArticle($id);
		}

		//fonction getters
		public function getContent(){
			return $this->content;
		}
		public function getUserId(){
			return $this->userId;
		}
		public function getDateComment(){
			$date = new \DateTime($this->dateComment);
			return $date->format('d-m-Y à H:i');
		}
		public function getArticleId(){
			return $this->articleId;
		}
		public function getIdParent(){
			return $this->idParent;
		}
		//fonctions setters
		public function setContent($content){
			if (is_string($content)) {
				$this->content = $content;
			}
			return $this;
		}
		public function setUserId($userId){
			$userId = (int)$userId;
			if ($userId > 0) {
				$this->userId = $userId;
			}
			return $this;
		}
		public function setDateComment($dateComment){
			$this->dateComment = $dateComment;
			return $this;
		}
		public function setArticleId($articleId){
			$articleId=(int)$articleId;
			if ($articleId > 0) {
				$this->articleId=$articleId;
			}
			return $this;
		}
		public function setIdParent($idParent){
			$idParent = (int)$idParent;
			if ($idParent >= 0) {
				$this->idParent = $idParent;
			}
			return $this;
			
		}
	}
?>
