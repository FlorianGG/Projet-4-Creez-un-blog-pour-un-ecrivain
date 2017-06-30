<?php 
	namespace model\manager;

	use model\ModelAbstract;
	use model\ModelPersonAbstract;

	class ManagerPersonAbstract extends ManagerAbstract{

		public function create(ModelAbstract $data){
			$pass = sha1(ModelPersonAbstract::PREFIXE_SHA1.$data->getPass());
			$data->setPass($pass);
			parent::create($data);
		}
		
		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son email
		public function readByEmail(string $email){
			//on prepare la requete filtré par l'email	
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->tableName . ' WHERE email =:email LIMIT 1');

			//on bind le filtre avec la valeur de $data
			$req->bindValue(":email", $email, \PDO::PARAM_STR);

			//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
			return $this->loadByQuery($req);
		}

		//function ReadByEmail qui permet de lire une ligne de la bdd en fonction de son pseudo
		public function readByPseudo(string $pseudo){
			//on prepare la requete filtré par le pseudo	
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->tableName . ' WHERE pseudo =:pseudo LIMIT 1');

			//on bind le filtre avec la valeur de $data
			$req->bindValue(":pseudo", $pseudo, \PDO::PARAM_STR);

			//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
			return $this->loadByQuery($req);
		}
	}




?>
