<?php
	namespace model\classes\models;


	
	abstract class ModelAbstract{
		protected $manager;

		//fonction save qui mix update et create en une seule fonction
		public function save(ModelAbstract $model){
			if (is_null($model->getId())) { //si l'id de l'article est nul c'est qu'il n'a pas été crée dans la bdd donc on le crée
				return $this->manager->create($model);
			}else{ //sinon c'est que le user existe dans la bbd donc on le modifie
				return $this->manager->modify($model); 
			}
		}

		public function delete(int $id){
			return $this->manager->delete($id);
		}

		//fonction d'hydration
		
		public function hydrate(array $data){
			foreach ($data as $key => $value) {
				$method = 'set' . ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
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
	}



?>
