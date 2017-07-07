<?php 
	namespace controller;

	use model\http\Request;
	use model\http\Response;
	use model\Article;
	use model\Comment;
	use model\Admin;
	use model\User;
	use view\View;	
	
	class CommentController extends FrontController{

		public function indexAction(int $id){
			$id = (int) $id;
			$data = null;
			$comments = (new Comment)->readAllWithArticle($id);
			if (empty($comments)) {
				return $comments;
			}else{
				foreach ($comments as $key => $value) {
					//on insère les données dans un tableau pour les envoyer dans la vue
					$array = [];
					$array['id'] = $value->getId();
					$array['content'] = $value->getContent();
					$array['dateComment'] = $value->getDateComment();
					$array['userPseudo'] = (new User)->read($value->getUserId())->getPseudo();
					$array['articleTitle'] = (new Article)->read($value->getArticleId())->getTitle();	
					$array['articleId'] = $value->getArticleId();			
					$array['idParent'] = $value->getIdParent();
					//On ajoute le tout dans un tableau qu'on renvoie dans la vue
					$data[] = $array;
				}
				$array = [];
				foreach ($data as $comment => $test) {
					$array[$data[$comment]['id']] = $data[$comment];
					
				}
				return $array;
			}
		}

		public function commentsWithChildren(array $data){
			$array = [];
			foreach ($data as $key => $value) {
				if ($data[$key]['idParent'] == 0) {
					
				}
			}
		}



	}
