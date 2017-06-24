<?php 
	namespace view;

	use model\Article;
	use view\listArticles;

	class View{
		protected $page;
		protected $title;

		public function __construct(Article $article){
			$this->page = file_get_contents('view/listArticles.php');
			$this->title = $article->getTitle();
		}

		public function listArticles(){

			return $this->page;

		}
	}




?>
