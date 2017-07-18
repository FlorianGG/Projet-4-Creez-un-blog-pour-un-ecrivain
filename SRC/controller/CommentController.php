<?php 
	namespace SRC\controller;

	use SRC\model\http\Request;
	use SRC\model\http\Response;
	use SRC\model\Article;
	use SRC\model\Comment;
	use SRC\model\Admin;
	use SRC\model\User;
	use SRC\view\View;
	use SRC\app\App;	
	
	class CommentController extends FrontController{

		public function indexAction(){
			$id = (int) $this->request->getParam('id');
			$data = [];
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
					$data[$array['id']] = $array;
				}
				$array = [];
				foreach ($data as $comment => $com) {
					if ($data[$comment]['idParent'] === 0) {
						$array[$data[$comment]['id']]= $data[$comment];
					}else{

						$array[$data[$comment]['idParent']]['response'][$comment] = $data[$comment];
					}
				}
				return $array;
			}
		}

		// http://localhost?controller=backend&action=addArticle
		//ajouter un article
		public function saveAction(){
			$post = $this->request->getPost();
			$comment = new Comment($post);
			$newRecord = $comment->save($comment);
			if ($newRecord) {
				if (!empty($post['id'])) {
					$this->app->addSuccessMessage('Les modifications ont bien été effectuées');
					$code = 200;
				}else{
					$this->app->addSuccessMessage('Le commentaire a bien été ajouté');
					$code = 200;
				}
			}else{
				$this->app->addErrorMessage('Une erreur est survenue durant l\'enregistrement');
				$code = 404;
			}
			$path ='?controller=article&action=show&id=' . $comment->getArticleId();
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}




	}
