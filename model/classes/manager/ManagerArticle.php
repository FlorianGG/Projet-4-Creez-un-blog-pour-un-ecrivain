<?php 

	class ManagerArticle{
		private $_bdd;
		private $_req;
		//function constructeur
		public function __construct(){
			$this->_bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}
		//Architecture du manager en CRUD + function SAVE =  mix entre Create et Update + fonction ReadAll
		//fonction read qui permet de lire un article en fonction de son id
		public function read($id){
			$id = (int)$id;

			//on prepare la requete filtré par l'id
			$req = $this->_bdd->prepare('SELECT * from article WHERE id=:id');

			//on bind le filtre avec la valeur de $id
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			//on execute la requête
			$executeIsOk = $req->execute();


			if ($executeIsOk) {
				$row = $req->fetch(PDO::FETCH_ASSOC);
				if (is_array($row)){
					//on ferme la requête
					$req->closeCursor();
					return $article = new Article($row);
				}
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}
		}

		//fonction readAll qui permet de lire tous les articles enregistrés dans la bdd
		public function readAll(){
			$articles = [];
			//on execute une requête pour afficher tous les articles
			$req = $this->_bdd->query('SELECT * FROM article ORDER BY id');

			//pour chaque article de la BDD on crée un objet article qu'on ajoute dans le tableau $articles
			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$articles [] = new Article($data);
			}

			//on ferme la requête
			$req->closeCursor();

			return $articles;
		}

		//fonction qui compte le nombre d'article dans la bdd
		public function count(){
			//on execute une requête pour afficher tous les articles
			$req = $this->_bdd->query('SELECT COUNT(*) AS numberArticle FROM article');

			//on affiche la requête
			
			$data = $req->fetch();
			//on ferme la requête
			$req->closeCursor();

			return $data['numberArticle'];
		}

		//fonction create qui permet d'enregistrer un article dans la bdd
		private function create(Article $data){
			//on prépare la requête pour insérer dans la bdd
			$req = $this->_bdd->prepare('INSERT INTO article(title, content, adminId, dateArticle) VALUES(:title, :content, :adminId, NOW())');
			//on bind les valeurs avec le contenu de l'objet en paramètre
			$req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
			$req->bindValue(':adminId', $data->getAdminId(), PDO::PARAM_INT);

			$executeIsOk = $req->execute();

			if (!$executeIsOk) {
				//on ferme la requête
				$req->closeCursor();
				return false;
			}else{
				//on met à jour l'objet passé en paramètre de la fonction create
				$data->hydrate([
					'id' => $this->_bdd->lastInsertId(),
					]);
				//on ferme la requête
				$req->closeCursor();
				return true;
			}
		}

		//fonction delete qui permet de surprimer un article de la bdd
		public function delete($id){
			$id = (int)$id;
			//on verifie que l'élément existe dans la bdd
			$req = $this->_bdd->prepare('SELECT id FROM article WHERE id=:id LIMIT 1');

			//on bind la variable avec l'id en paramètre
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			$result = $req->execute();

			if ($result) {
				//on ferme la requête précédente
				$req->closeCursor();

				//on prepare la requete qui va supprimer un article en fonction de l'id
				$req = $this->_bdd->prepare('DELETE FROM article WHERE id=:id LIMIT 1');

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

		//fonction qui permet de modifier un article dans la bdd
		private function modify(Article $data){

			//on prepare la requête qui va modifier l'article en fonction de l'id en paramètre
			$req = $this->_bdd->prepare('UPDATE article SET titre=:title, content=:content, dateArticle=NOW() WHERE id=:id');

			//on bind les valeurs avec le contenu de l'objet en paramètre
			$req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
			$req->bindValue(':id', $data->getId(), PDO::PARAM_INT);

			//on execute la requete avec un test
			$executeIsOk = $req->execute();

			if ($executeIsOk) {
				return true;
			}else{
				return false;
			}
		}

		//fonction save qui mix update et create en une seule fonction
		public function save(Article $data){

			if (is_null($data->getId())) { //si l'id de l'article est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				$this->create($data);
			}else{ //sinon c'est que le user existe dans la bbd donc on le modifie
				$this->modify($data); 
			}
		}


	}


?>

