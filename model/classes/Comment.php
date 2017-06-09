<?php 
	class Comment{
		protected $_id;
		protected $_title;
		protected $_content;
		protected $_userId;
		protected $_dateComment;
		protected $_articleId;
		protected $_idParent;
		
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
				if (method_exists($this, $method)){
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
		public function setDateCommentaire($dateComment){
			$this->_dateComment = $dateComment;
		}
		public function setArticleId($articleId){
			$articleId=(int)$articleId;
			if ($articleId > 0) {
				$this->_articleId=$articleId;
			}
		}
		public function setIdParent($idParent){
			$idParent = (int)$idParent;
			if ($idParent > 0) {
				$this->_idParent = $idParent;
			}
			
		}
	}
?>
