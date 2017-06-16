<?php 
	abstract class ManagerAbstract{
		protected $_bdd;
		protected $_tableName;

		//function constructeur
		protected function __construct(){
			$this->_bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}

		//function loadByQuery($req) s'occupe d'exécuter la requête read et de retourner un objet User
		protected function loadByQuery($req){
			//on execute la requête
			$executeIsOk = $req->execute();

			if ($executeIsOk) {
				$row = $req->fetch(PDO::FETCH_ASSOC);
				if (is_array($row)){
					//on ferme la requête
					$req->closeCursor();
					return new $this->_tableName($row);
				}
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}
		}
		//Ensembles des fonctions du format CRUD
		
		/**
		 * FONCTION CREATE
		 */
		
		//fonction qui permet d'ajouter une ligne dans la bdd
		public function create(Article $data){
			var_dump($data);
			// foreach ($data as $attribut => $value) {

			// 	echo $attribut . 'et' .  $value;
			// }


			// //on prépare la requête pour insérer dans la bdd
			// $req = $this->_bdd->prepare('INSERT INTO article(title, content, adminId, dateArticle) VALUES(:title, :content, :adminId, NOW())');
			// //on bind les valeurs avec le contenu de l'objet en paramètre
			// $req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);
			// $req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
			// $req->bindValue(':adminId', $data->getAdminId(), PDO::PARAM_INT);

			// $executeIsOk = $req->execute();

			// if (!$executeIsOk) {
			// 	//on ferme la requête
			// 	$req->closeCursor();
			// 	return false;
			// }else{
			// 	//on met à jour l'objet passé en paramètre de la fonction create
			// 	$data->hydrate([
			// 		'id' => $this->_bdd->lastInsertId(),
			// 		]);
			// 	//on ferme la requête
			// 	$req->closeCursor();
			// 	return true;
			// }
		}



		/**
		 * FONCTION READS
		 */
		

		//fonction read qui permet de lire une ligne de la bdd en fonction de son id
		public function read($id){
			$id = (int)$id;

			//on prepare la requete filtré par l'id
			$req = $this->_bdd->prepare('SELECT * from ' . $this->_tableName . ' WHERE id=:id');

			//on bind le filtre avec la valeur de $id
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			return $this->loadByQuery($req);
		}


		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son email
		public function readByEmail(string $email){
				//on prepare la requete filtré par l'email	
				$req = $this->_bdd->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE email =:email');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":email", $email, PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				return $this->loadByQuery($req);
		}

		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son pseudo
		public function readByPseudo(string $pseudo){
				//on prepare la requete filtré par le pseudo	
				$req = $this->_bdd->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE pseudo =:pseudo');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				return $this->loadByQuery($req);
		}

		//fonction readAll qui permet de lire l'ensemble des lignes de la bdd
		public function readAll(){
			$array = [];
			//on prepare la requête pour avoir l'ensemble des users
			$req = $this->_bdd->query('SELECT * FROM ' . $this->_tableName . ' ORDER BY id');
			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$array[] = new $this->_tableName($data);
			}
			//on ferme la requête
			$req->closeCursor();

			return $array;
		}


	}





?>
