<?php 
	namespace model;

	use model\manager\CommentManager;

	
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

		//fonction getters
		public function getId(){
			return $this->id;
		}
		public function getContent(){
			return $this->content;
		}
		public function getUserId(){
			return $this->userId;
		}
		public function getDateComment(){
			return $this->dateComment;
		}
		public function getArticleId(){
			return $this->articleId;
		}
		public function getIdParent(){
			return $this->idParent;
		}
		//fonctions setters
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->id = $id;
			}
			return $this;
			
		}
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
