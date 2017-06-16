<?php 
	class ManagerAdmin{
		private $_bdd;
		//function constructeur
		public function __construct(){
			$this->_bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8;', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}

		//Architecture du manager en CRUD + function SAVE =  mix entre Create et Update + fonction ReadAll + functions verification email et pseudo

		//fonction Read qui permet de sélectionner un admin
		public function read($data){
			if (is_int($data)) { //data représente l'ID
				//on prepare la requete filtré par l'id
				$req = $this->_bdd->prepare('SELECT * FROM admin WHERE id =:id');
				//on bind le filtre avec la valeur de $data
				$req->bindValue(":id", $data, PDO::PARAM_INT);
				//on execute la requête
				$executeIsOk = $req->execute();
				//on retourne un nouvel objet Admin
				if ($executeIsOk) {
					$row = $req->fetch(PDO::FETCH_ASSOC);
					if (is_array($row)) {
						//on ferme la requête
						$req->closeCursor();
						return $admin = new Admin($row);
					}
				}else{
					//on ferme la requête
					$req->closeCursor();
					return null;
				}
			}elseif (is_string($data)) { //data représente le pseudo
				//on prepare la requete filtré par le pseudo	
				$req = $this->_bdd->prepare('SELECT * FROM admin WHERE pseudo =:pseudo');
				//on bind le filtre avec la valeur de $data
				$req->bindValue(":pseudo", $data, PDO::PARAM_STR);
				//on execute la requête
				$executeIsOk = $req->execute();
				//on retourne un nouvel objet Admin
				if ($executeIsOk) {
					$row = $req->fetch(PDO::FETCH_ASSOC);
					if (is_array($row)) {
						//on ferme la requête
						$req->closeCursor();
						return $admin = new Admin($row);
					}
				}else{
					//on ferme la requête
					$req->closeCursor();
					return null;
				}
			}
		}
		//fonction Real All
		public function readAll(){
			$admins = [];
			//on prepare la requête pour avoir l'ensemble des admins
			$req = $this->_bdd->query('SELECT * FROM admin ORDER BY pseudo');
			while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
				$admins[] = new Admin($data);
			}
			//on ferme la requête
			$req->closeCursor();

			return $admins;
		}
		//fonction qui compte le nombre de admins dans la bdd
		public function count(){
			//on execute une requête pour afficher tous les admins
			$req = $this->_bdd->query('SELECT COUNT(*) AS numberAdmins FROM admin');
			// on affiche la requête
			$data = $req->fetch();
			//on ferme la requête
			$req->closeCursor();
			return $data['numberAdmins'];
		}
		//fonction create qui ajoute un admin à la bdd
		private function create(Admin $data){
			//on prepare la requête d'ajout d'un nouveau admin dans la BDD
			$req = $this->_bdd->prepare('INSERT INTO admin(pseudo, pass, email) VALUES (:pseudo, :pass, :email)');
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
		//fonction delete qui supprimer un admin de la bbd
		public function delete($id){
					$id = (int)$id;
					//on verifie que l'élément existe dans la bdd
					$req = $this->_bdd->prepare('SELECT id FROM admin WHERE id=:id LIMIT 1');

					//on bind la variable avec l'id en paramètre
					$req->bindValue(':id', $id, PDO::PARAM_INT);

					$result = $req->execute();

					if ($result) {
						//on ferme la requête précédente
						$req->closeCursor();

						//on prepare la requete qui va supprimer un admin en fonction de l'id
						$req = $this->_bdd->prepare('DELETE FROM admin WHERE id=:id LIMIT 1');

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
		//fonction update qui modifie les attributs du admin en paramètre
		private function update(Admin $data){
			//on prepare la requête qui modififie dans la bdd le admin en paramètre
			$req = $this->_bdd->prepare('UPDATE admin SET pseudo=:pseudo, pass=:pass, email=:email WHERE id=:id LIMIT 1 ');
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
		public function save(Admin $data){
			if (is_null($data->getId())) { //si l'id du admin est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				return $this->create($data);
				
			}else{ //sinon c'est que le admin existe dans la bbd donc on le modifie
				return $this->update($data);
			}
		}
		//fonction check qui vérifie s'il n'y a pas déjà un admin avec le même pseudo ou la même adresse mail
		public function checkPseudo(Admin $data){
			//on prepare la requete filtré par le pseudo
			$req = $this->_bdd->prepare('SELECT * FROM admin WHERE pseudo =:pseudo');
			//on bind les filtres
			$req->bindValue(":pseudo", $data->getPseudo(), PDO::PARAM_STR);
			//on execute la requête
			$req->execute();
			//on retourne un bouléen
			return $req->fetch();
		}
		public function checkEmail(Admin $data){
			//on prepare la requete filtré par l'email
			$req = $this->_bdd->prepare('SELECT * FROM admin WHERE email =:email');
			//on bind les filtres
			$req->bindValue(":email", $data->getEmail(), PDO::PARAM_STR);
			//on execute la requête
			$req->execute();
			//on retourne un bouléen
			return $req->fetch();
		}
	}




?>
