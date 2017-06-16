<?php 

	class ManagerArticle extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->_tableName = 'Article';
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

