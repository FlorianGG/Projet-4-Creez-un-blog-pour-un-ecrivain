<?php 
	namespace model\classes\models;

	use model\classes\manager\CommentManager;

	
	class Comment extends ModelAbstract{
		protected $_id;
		protected $_content;
		protected $_userId;
		protected $_dateComment;
		protected $_articleId;
		protected $_idParent;
		
		//fonction constructeur avec un tableau en paramètre
		public function __construct(array $data){
			$this->hydrate($data);
			$this->manager = new CommentManager;
		}

		//fonction getters
		public function getId(){
			return $this->_id;
		}
		public function getContent(){
			return $this->_content;
		}
		public function getUserId(){
			return $this->_userId;
		}
		public function getDateComment(){
			return $this->_dateComment;
		}
		public function getArticleId(){
			return $this->_articleId;
		}
		public function getIdParent(){
			return $this->_idParent;
		}
		//fonctions setters
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->_id = $id;
			}
			return $this;
			
		}
		public function setContent($content){
			if (is_string($content)) {
				$this->_content = $content;
			}
			return $this;
		}
		public function setUserId($userId){
			$userId = (int)$userId;
			if ($userId > 0) {
				$this->_userId = $userId;
			}
			return $this;
		}
		public function setDateComment($dateComment){
			$this->_dateComment = $dateComment;
			return $this;
		}
		public function setArticleId($articleId){
			$articleId=(int)$articleId;
			if ($articleId > 0) {
				$this->_articleId=$articleId;
			}
			return $this;
		}
		public function setIdParent($idParent){
			$idParent = (int)$idParent;
			if ($idParent >= 0) {
				$this->_idParent = $idParent;
			}
			return $this;
			
		}
	}
?>
