<?php
	namespace OCProjet4\model\manager; 

	use OCProjet4\model\Comment;

	 
	class CommentManager extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->tableName = 'comment';
		}


		//fonction readAllWithParent qui permet d'avoir la liste de tous les commentaires en fonction de l'id du parent
		public function readAllWithArticle ($idArticle){
			$idArticle = (int)$idArticle;
			$comments = [];

			//on prepare la requête en fonction l'idArticle
			$req = $this->bdd->prepare('SELECT * FROM comment WHERE articleId=:articleId ORDER BY id');

			//on bind la valeur de l'id
			$req->bindValue(':articleId', $idArticle, \PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();

			//pour chaque comment de la BDD on crée un objet comment qu'on ajoute dans le tableau $comments
			if ($executeIsOk) {
				while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
					$comments [] = new Comment($data);
				}
				//on ferme la requête
				$req->closeCursor();

				return $comments;
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}

		}
	}
?>
