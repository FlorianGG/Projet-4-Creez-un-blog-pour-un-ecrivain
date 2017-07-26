<?php
	namespace OCProjet4\model\manager; 


	class ArticleManager extends ManagerAbstract{

		//on execute le constructeur en récupérant celui du parent
		public function __construct(){
			$this->tableName = 'article';
			parent::__construct();
			
		}

		//fonction previousId qui permet de récupèrer l'article précédent dans la base de donnée
		public function previousId($id){
			$id =(int) $id;
			$array = [];
			//on prepare la requête pour sélectionner le premier article qui a un id inferieur à celui envoyé en param
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id<:id AND isDraft IS NULL ORDER BY id DESC LIMIT 1');

			//on bind le filtre avec la valeur de $id
			$req->bindValue(':id', $id, \PDO::PARAM_INT);

			return $this->loadByQuery($req);
		}

		//fonction previousId qui permet de récupèrer l'article suivant dans la base de donnée
		public function nextId($id){
			$id =(int) $id;
			$array = [];
			//on prepare la requête pour sélectionner le premier article qui a un id supérieur à celui envoyé en param
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id>:id AND isDraft IS NULL ORDER BY id ASC LIMIT 0,1');

			//on bind le filtre avec la valeur de $id
			$req->bindValue(':id', $id, \PDO::PARAM_INT);
			// $req->bindValue(':isDraft', 'NULL', \PDO::PARAM_STR);

			return $this->loadByQuery($req);
		}

	}


?>
