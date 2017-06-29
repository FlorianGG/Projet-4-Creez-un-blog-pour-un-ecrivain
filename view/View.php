<?php 
	namespace view;

	class View{
		// Nom du fichier associé à la vue
		protected $file;

		//Titre de la vue
		protected $title;

		public function __construct($action){
			//Déterminer le nom du fichier vue à partir de l'action
			$this->file = 'view/content/' . $action . 'Action.php';
		}

		//Générer et afficher la vue
		public function generate($data = null){
			//Générer la partie spécifique de la vue
			$content = $this->generateFile($this->file, $data);
			//Génération du fichier de base avec la partie spécifique
			$view = $this->generateFile('view/layout.php', array('title' => $this->title, 'content' => $content));
			//renvoi de la vue au navigateur
			return $view;
		}

		//Générer un fichier vueet renvoie le résultat produit
		private function generateFile($file, $data = null){
			if (file_exists($file)) {
				
				if (isset($data)) {
					// Rend les éléments du tableau $donnees accessibles dans la vue
					extract($data);
				}
				
				// Démarage de la temporisation
				ob_start();
				// Inclue le fichier vue
				// Son résultat est placé dans le tampon de sortie
				require $file;
				// Arrêt de la temporisation et renvoi du tampon de sortie
				return ob_get_clean();
			}else{
				echo "Erreur 404";
			}
		}
	}




?>
