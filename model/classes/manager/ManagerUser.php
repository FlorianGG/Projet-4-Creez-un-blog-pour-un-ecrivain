<?php 
	class ManagerUser{
		private $_bdd;

		//function constructeur
		public function __construct(){
			$this->_bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}
		//Architecture du manager en CRUD + function SAVE =  mix entre Create et Update + fonction ReadAll + functions verification email et pseudo
		
		//function loadByQuery($req) s'occupe d'exécuter la requête read et de retourner un objet User
		protected function loadByQuery($req){
			//on execute la requête
			$executeIsOk = $req->execute();
			//on retourne un nouvel objet User
			if ($executeIsOk) {
				$row = $req->fetch(PDO::FETCH_ASSOC);
				if (is_array($row)) {
					//on ferme la requête
					$req->closeCursor();
					return $user = new User($row);
				}
			}else{
				//on ferme la requête
				$req->closeCursor();
				return null;
			}
		}
		//fonction Read(int $data)
		public function read(int $id){
			//on prepare la requete filtré par l'id
			$req = $this->_bdd->prepare('SELECT * FROM user WHERE id =:id');

			//on bind le filtre avec la valeur de $data
			$req->bindValue(":id", $id, PDO::PARAM_INT);

			//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
			$this->loadByQuery($req);
		}

		//function ReadByEmail qui récupère un User par son email
		public function readByEmail(string $email){
				//on prepare la requete filtré par l'email	
				$req = $this->_bdd->prepare('SELECT * FROM user WHERE email =:email');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":email", $email, PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				$this->loadByQuery($req);
		}

		//function ReadByPseudo qui récupère un User par son pseudo
		public function readByPseudo(string $pseudo){
				//on prepare la requete filtré par le pseudo	
				$req = $this->_bdd->prepare('SELECT * FROM user WHERE pseudo =:pseudo');

				//on bind le filtre avec la valeur de $data
				$req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);

				//on execute loadByQuery($req) pour exécuter la requête read et de retourner un objet User
				$this->loadByQuery($req);
		}

		//fonction Real All
		public function readAll(){
			$users = [];
			//on prepare la requête pour avoir l'ensemble des users
			$req = $this->_bdd->query('SELECT * FROM user ORDER BY pseudo');
			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$users[] = new User($data);
			}
			//on ferme la requête
			$req->closeCursor();

			return $users;
		}
		//fonction qui compte le nombre de users dans la bdd
		public function count(){
			//on execute une requête pour afficher tous les users
			$req = $this->_bdd->query('SELECT COUNT(*) AS numberUsers FROM user');
			// on affiche la requête
			$data = $req->fetch();
			//on ferme la requête
			$req->closeCursor();
			return $data['numberUsers'];
		}
		//fonction create qui ajoute un user à la bdd
		private function create(User $data){
			//on prepare la requête d'ajout d'un nouveau user dans la BDD
			$req = $this->_bdd->prepare('INSERT INTO user(pseudo, pass, email) VALUES (:pseudo, :pass, :email)');
			//on bind les variables
			$req->bindValue(":pseudo", $data->getPseudo());
			$req->bindValue(":pass", $dara->getPass());
			$req->bindValue(":email", $dara->getEmail());
			//on exectue la requête
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
		//fonction delete qui supprimer un user de la bbd
		public function delete($id){
			$id = (int)$id;
			//on verifie que l'élément existe dans la bdd
			$req = $this->_bdd->prepare('SELECT id FROM user WHERE id=:id LIMIT 1');

			//on bind la variable avec l'id en paramètre
			$req->bindValue(':id', $id, PDO::PARAM_INT);

			$result = $req->execute();

			if ($result) {
				//on ferme la requête précédente
				$req->closeCursor();

				//on prepare la requete qui va supprimer un user en fonction de l'id
				$req = $this->_bdd->prepare('DELETE FROM user WHERE id=:id LIMIT 1');

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
		//fonction update qui modifie les attributs du user en paramètre
		private function update(User $data){
			//on prepare la requête qui modififie dans la bdd le user en paramètre
			$req = $this->_bdd->prepare('UPDATE user SET pseudo=:pseudo, pass=:pass, email=:email WHERE id=:id LIMIT 1 ');
			//on bind les variables
			$req->bindValue(':id', $data->getId(), PDO::PARAM_INT);
			$req->bindValue(":pseudo", $data->getPseudo(), PDO::PARAM_STR);
			$req->bindValue(":pass", $data->getPass(), PDO::PARAM_STR);
			$req->bindValue(":email", $data->getEmail(), PDO::PARAM_STR);
			//on exectue la requête
			$executeIsOk = $req->execute();
			//on ferme la requête
			$req->closeCursor();
			
			if ($executeIsOk) {
				return true;
			}else{
				return false;
			}
		}
		//fonction save qui mix update et create en une seule fonction
		public function save(User $data){
			if (is_null($data->getId())) { //si l'id du user est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				return $this->create($data);
				
			}else{ //sinon c'est que le user existe dans la bbd donc on le modifie
				return $this->update($data);
			}
		}
	}
?>
