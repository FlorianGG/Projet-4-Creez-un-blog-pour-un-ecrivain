<?php
	namespace model\manager;

	use model\ModelAbstract;

	abstract class ManagerAbstract{
		protected $_bdd;
		protected $_tableName;

		//function constructeur
		protected function __construct(){
			$this->_bdd = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
		}

		//function loadByQuery($req) s'occupe d'exécuter la requête read et de retourner un objet User
		protected function loadByQuery($req){
			//on execute la requête
			$executeIsOk = $req->execute();

			if ($executeIsOk) {
				$row = $req->fetch(\PDO::FETCH_ASSOC);
				if (is_array($row)){
					//on ferme la requête
					$req->closeCursor();
					$ref = 'model\\' . $this->_tableName;
					return new $ref($row);
				}
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}
		}

		//function qui va nettoie l'objet et retourne un tablrau conforme pour les requêtes
		private function convertData(ModelAbstract $data){
			//on récupère l'ensemble des attributs de la class en paramètre
			//on utilise la fonction returnData car les attributs sont en protected
			$array = $data->returnData();

			//on supprime la dernière colonne qui correspond au manager
			$lastLignDelete = array_pop($array);

			return $array;

		}

		//fonction qui compte le nombre d'élément dans la bdd
		public function count(){
			//on execute une requête pour afficher tous les articles
			$req = $this->_bdd->query('SELECT COUNT(*) AS numberElement FROM ' . $this->_tableName);

			//on affiche la requête
			
			$data = $req->fetch();
			//on ferme la requête
			$req->closeCursor();

			return $data['numberElement'];
		}

		//Ensembles des fonctions du format CRUD
		
		/**
		 * FONCTION CREATE
		 */
		
		//fonction qui permet d'ajouter une ligne dans la bdd
		public function create(ModelAbstract $data){
			//on récupère les data nettoyées
			
			$array = $this->convertData($data);

			//on prépare les variables string à utiliser dans la requête
			$param = "";
			$param2 = "";

			//on récupère toutes les keys de la classe et on crée 2 string adaptées au format sql
			foreach ($array as $key => $value) {
				$param .=  ', ' . trim($key,'_');
				$param2 .= ', :' . trim($key,'_');
				$param = trim($param,', ');
				$param2 = trim($param2,', ');
			}
			
			//on prepare notre requête avec les variables adaptées en string
			$req = $this->_bdd->prepare('INSERT INTO ' . $this->_tableName . '(' . $param . ') VALUES(' . $param2 . ')');

			//on bind les valeurs avec le contenu du tableau retourné par la fonction returnData de l'objet en paramètre
			foreach ($array as $key => $value) {
				$newKey = trim($key,'_');
				$req->bindValue(':' . $newKey, $value);
			}

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

		/**
		 * FONCTION READS
		 */
		

		//fonction read qui permet de lire une ligne de la bdd en fonction de son id
		public function read($id){
			$id = (int)$id;

			//on prepare la requete filtré par l'id
			$req = $this->_bdd->prepare('SELECT * from ' . $this->_tableName . ' WHERE id=:id');

			//on bind le filtre avec la valeur de $id
			$req->bindValue(':id', $id, \PDO::PARAM_INT);

			return $this->loadByQuery($req);
		}


		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son email
		public function readByEmail(string $email){
				//on prepare la requete filtré par l'email	
				$req = $this->_bdd->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE email =:email');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":email", $email, \PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				return $this->loadByQuery($req);
		}

		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son pseudo
		public function readByPseudo(string $pseudo){
				//on prepare la requete filtré par le pseudo	
				$req = $this->_bdd->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE pseudo =:pseudo');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":pseudo", $pseudo, \PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				return $this->loadByQuery($req);
		}

		//fonction readAll qui permet de lire l'ensemble des lignes de la bdd
		public function readAll(){
			$array = [];
			//on prepare la requête pour avoir l'ensemble des users
			$req = $this->_bdd->query('SELECT * FROM ' . $this->_tableName . ' ORDER BY id');
			while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
				$ref = 'model\\' . $this->_tableName;
				$array[] = new $ref($data);
			}
			//on ferme la requête
			$req->closeCursor();

			return $array;
		}

		/**
		 * FONCTION MODIFY
		 */

		//fonction qui permet de modifier un article dans la bdd
		public function modify(ManagerAbstract $data){
			//on récupère les data nettoyées
			$array = $this->convertData($data);

			//on dépile l'id avant de préparer la variable string
			$arrayId = array_shift($array);

			//on prépare la variables string à utiliser dans la requête
			$param = "";

			//on récupère les keys de la classe et on crée 2 string adaptées au format sql
			foreach ($array as $key => $value) {
				$param .=  ', ' . trim($key,'_') . '=:' . trim($key,'_');
				$param = trim($param,', ');
			}

			//on réempile l'id dans le tableau
			$array['_id'] = $arrayId;

			//on prepare la requête qui va modifier l'article en fonction de l'id en paramètre
			$req = $this->_bdd->prepare('UPDATE ' . $this->_tableName .' SET ' . $param . ' WHERE id=:id');

			//on bind les valeurs avec le contenu du tableau retourné par la fonction returnData de l'objet en paramètre
			foreach ($array as $key => $value) {
				$newKey = trim($key,'_');
				$req->bindValue(':' . $newKey, $value);
			}

			//on execute la requete avec un test
			$executeIsOk = $req->execute();

			if ($executeIsOk) {
				return true;
			}else{
				return false;
			}
		}

		/**
		 * FONCTION DELETE
		 */

		//fonction delete qui permet de surprimer un article de la bdd
		public function delete($id){
			$id = (int)$id;
			
			//on prepare la requete qui va supprimer un article en fonction de l'id
			$req = $this->_bdd->prepare('DELETE FROM ' . $this->_tableName . ' WHERE id=:id LIMIT 1');

			//on bind la variable avec l'id en paramètre
			$req->bindValue(':id', $id, \PDO::PARAM_INT);

			//on execute la requête avec un test
			$executeIsOk = $req->execute();

			//on ferme la requête précédente
			$req->closeCursor();

			if ($executeIsOk) {
				return true;
			}else{
				return false;
			}
		

		}

	}

