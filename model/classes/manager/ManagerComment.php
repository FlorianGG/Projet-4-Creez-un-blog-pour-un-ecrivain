<?php 
	class ManagerComment{
		private $_bdd;
		private $_req;
		//function constructeur
		public function __construct(){
			$this->_bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}
		//Architecture du manager en CRUD + function SAVE =  mix entre Create et Update + fonction ReadAll + fonction ReadAllWithParent

		//fonction read qui permet de lire un commentaire en fonction de son id
		public function read($id){
			$id = (int)$id;

			//on prepare la requête en fonction l'id
			$req = $this->_bdd->prepare('SELECT * FROM comment WHERE id=:id');

			//on bind la valeur de l'id
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();

			if (executeIsOk) {
				$row = $req->fetch(PDO::FETCH_ASSOC);
				if (is_array($row)) {
					//on ferme la requête
					$req->closeCursor();
					return $comment = new Comment($row);
				}
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}
		}

		//fonction readAllWithParent qui permet d'avoir la liste de tous les commentaires en fonction de l'id du parent
		public function readAllWithParent ($idParent){
			$idParent = (int)$idParent;
			$comments = [];

			//on prepare la requête en fonction l'idPrent
			$req = $this->_bdd->prepare('SELECT * FROM comment WHERE idParent=:idParent ORDER BY id');

			//on bind la valeur de l'id
			$req->bindValue(':idParent', $idParent, PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();

			//pour chaque comment de la BDD on crée un objet comment qu'on ajoute dans le tableau $comments

			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$comments [] = new Comment($data);
			}

			//on ferme la requête
			$req->closeCursor();

			return $comments;
		}

		//fonction readAll qui permet d'avoir la liste de tous les commentaires
		public function readAll(){
			$comments = [];

			//on execute la requête
			$req = $this->_bdd->query('SELECT * FROM comment ORDER BY id');

			//pour chaque comment de la BDD on crée un objet comment qu'on ajoute dans le tableau $comments
			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$comments [] = new Comment($data);
			}

			//on ferme la requête
			$req->closeCursor();

			return $comments;
		}

		//fonction qui permet d'enregistrer un article en bdd
		private function create(Comment $data){
			//on prepare la requête d'insertion
			$req = $this->_bdd->prepare('INSERT INTO comment(title, content, userId, dateComment, articleId, idParent) VALUES(:title, :content, :userId, NOW(), :articleId, :idParent)');

			//on bind les valeurs avec le contenu de l'objet en paramètre
			$req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);		
			$req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
			$req->bindValue(':userId', $data->getUserId(), PDO::PARAM_INT);
			$req->bindValue(':articleId', $data->getArticleId(), PDO::PARAM_INT);
			$req->bindValue(':idParent', $data->getIdParent(), PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();
			if (!executeIsOk) {
				//on ferme la requête
				$req->closeCursor();
				return false;
			}else{
				$data->hydrate([
					//on met à jour l'objet passé en paramètre de la fonction create
					'id' => $req->lastInsertId(),
					]);
				//on ferme la requête
				$req->closeCursor();
				return true;
			}
		}

		//fonction qui permet de supprimer un comment de la bdd
		public function delete($id){
			$id = (int)$id;
			//on verifie que l'élément existe dans la bdd
			$req = $this->_bdd->prepare('SELECT id FROM comment WHERE id=:id LIMIT 1');

			//on bind la variable avec l'id en paramètre
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			$result = $req->execute();

			if ($result) {
				//on ferme la requête précédente
				$req->closeCursor();

				//on prepare la requete qui va supprimer un comment en fonction de l'id
				$req = $this->_bdd->prepare('DELETE FROM comment WHERE id=:id LIMIT 1');

				//on bind la variable avec l'id en paramètre
				$req->bindValue(':id', $id, PDO::PARAM_INT);

				//on execute la requête avec un test
				$executeIsOk = $req->execute();

				//on ferme la requête précédente
				$req->closeCursor();

				if ($executeIsOk) {
					return true;
				}else{
					return false;
				}
			}else{
				return null;
			}

		}

		//fonction modify qui permet la modification d'un commentaire en fonction de l'objet en paramètre
		private function modify(Comment $data){

			//on prepare la requête permettant de modifiant un comment
			$req = $this->_bdd->prepare('UPDATE comment SET title=:titre, content=:content, userId=:userId, dateComment=NOW(), articleId=:articleId, idParent=:idParent WHERE id=:id LIMIT 1');

			//on bind les valeurs
			$req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);		
			$req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
			$req->bindValue(':userId', $data->getUserId(), PDO::PARAM_INT);
			$req->bindValue(':articleId', $data->getArticleId(), PDO::PARAM_INT);
			$req->bindValue(':idParent', $data->getIdParent(), PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();

			//on ferme la requête
			$req->closeCursor();

			if (executeIsOk) {
				return true;
			}else{
				return false;
			}
		}

		//fonction save qui mix update et create en une seule fonction

		public function save(Comment $data){
			if (is_null($data->getId())) {//si l'id du comment est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				$this->create($data);
			}else{//sinon c'est que le user existe dans la bbd donc on le modifie
				$this->modify($data);
			}
		}
	}
?>
