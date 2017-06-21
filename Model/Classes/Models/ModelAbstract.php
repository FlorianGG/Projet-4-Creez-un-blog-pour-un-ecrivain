<?php
	namespace Model\Classes\Models;

	
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
	}



?>
