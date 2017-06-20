<?php 
	class ManagerComment extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			parent::__construct();
			$this->_tableName = 'Comment';
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
	}
?>
