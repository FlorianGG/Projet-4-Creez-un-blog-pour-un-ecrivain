<?php
	namespace OCProjet4\model;


	
	abstract class ModelAbstract{
		protected $manager;
		//fonctions qui permettent d'encapsuler la gestion du manager par le model
		//fonction save qui mix update et create en une seule fonction
		public function save(ModelAbstract $model = null){
			if (is_null($model->getId())) { //si l'id de l'article est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				return $this->manager->create($model);
			}else{ //sinon c'est que le user existe dans la bbd donc on le modifie
				return $this->manager->modify($model); 
			}
		}
		//function delete qui fait appel au manager et sa fonction delete
		public function delete(int $id){
			return $this->manager->delete($id);
		}

		//function count qui fait appel au manager et sa fonction count
		public function count(){
			return $this->manager->count();
		}

		//function read qui fait appel au manager et sa fonction read
		public function read(int $id){
			return $this->manager->read($id);
		}

		//function readAll qui fait appel au manager et sa fonction readAll
		public function readAll(){
			return $this->manager->readAll();
		}

		//fonction d'hydration
		
		public function hydrate(array $data = null){
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					$method = 'set' . ucfirst($key);
					if (method_exists($this, $method)) {
						$this->$method($value);
					}
				}
			}
		}

		//fonction chargée de récupérer tous les attributs et de les retourner dans un tableau. Le but étant de ne pas passer les attributs en public
		public function returnData(){
			$data = [];
			foreach ($this as $key => $value) {
				$data[$key] = $value;
			}
			return $data;
		}
		//GETTER Commun à tous les models
		public function getId(){
			return $this->id;
		}
		
		//SETTER Commun à tous les models
		public function setId($id){
			$id = (int)$id;
			if ($id > 0) {
				$this->id = $id;
			}
			return $this;
		}
	}



?>
