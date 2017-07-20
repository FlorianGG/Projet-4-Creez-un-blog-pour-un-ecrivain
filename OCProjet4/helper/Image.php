<?php 
	namespace OCProjet4\helper;

	use OCProjet4\app\App;
	use OCProjet4\model\http\Response;
	

	class Image{

		protected $app;

		public function __construct(){
			$this->app = new App;
			$this->response = new Response;
		}
		//fonction qui vérifie si l'image issue du champs en paramètre existe bien
		//Elle effectue également des test sur la conformité de l'extension et la taille
		//Enfin elle crée un dossier avec le nom de l'article et la stock en la renommant
		public function validateImgArticle($name, $articleId){
			// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
			if (isset($_FILES[$name]) AND $_FILES[$name]['error'] == 0){
		        // Testons si le fichier n'est pas trop gros
		        if ($_FILES[$name]['size'] <= 1000000){
	                // Testons si l'extension est autorisée
	                $nameFile = pathinfo($_FILES[$name]['name']);
	                $extensionFile = $nameFile['extension'];
	                $extensionsAccepted = array('jpg', 'jpeg');
	                if (in_array($extensionFile , $extensionsAccepted)){
                		$url = 'web/img/article/' . $articleId;
                		if (!file_exists($url)) {
                			mkdir($url,0777);
                		}
                        
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES[$name]['tmp_name'], $url . '/main' . $articleId . '.' . $nameFile['extension']);
                        $img = $url . '/main' . $articleId . '.' . $nameFile['extension'];
                        if (file_exists($img)) {
                        	$main = $url . '/main' . $articleId;
                        	$this->resizeImg($img, 'main', $main);
                        	$miniature = $url . '/miniature' . $articleId;
                        	$this->resizeImg($main . '.jpg', 'miniature', $miniature);

                        }
	                }
		        }
			}
		}

		function validateImg($name){
			// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
			if (isset($_FILES[$name]) AND $_FILES[$name]['error'] == 0){
		        // Testons si le fichier n'est pas trop gros
		        if ($_FILES[$name]['size'] <= 1000000){
	                // Testons si l'extension est autorisée
	                $nameFile = pathinfo($_FILES[$name]['name']);
	                $extensionFile = $nameFile['extension'];
	                $extensionsAccepted = array('jpg', 'jpeg');
	                if (in_array($extensionFile , $extensionsAccepted)){
                		$url = 'web/img/' . $name;
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES[$name]['tmp_name'], $url . '/' . $name . '.' . $nameFile['extension']);
                        $img = $url . '/' . $name . '.' . $nameFile['extension'];
                        if (file_exists($img)) {
                        	$main = $url . '/' . $name;
                        	$this->resizeImg($img, $name, $main);
                        	$miniature = $url . '/miniature' . $name;
                        	$this->resizeImg($main . '.jpg', 'miniature', $miniature);
                        }
	                }
		        }
			}
			$path ='?interface=admin&controller=home&action=index';
			$code = 200;
			$this->response->redirectUrl($this->app->getUrl($path), $code);
		}

		public function resizeImg($imgSource, $type, $newFile){
			$source = imagecreatefromjpeg($imgSource); // La photo est la source
			switch ($type) {
				case 'main':
					$x = 1200;
					$y = 600;
					break;
				case 'miniature':
					$x = 200;
					$y = 150;
					break;
				case 'autor':
					$x = 600;
					$y = 800;
					break;
				case 'home':
					$x = 1500;
					$y = 750;
					break;
			}
			$destination = imagecreatetruecolor($x, $y); // On crée la photo redimensionnée en fonction de son type

			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);

			// On crée la nouvelle photo
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

			// On enregistre la nouvelle photo redimensionnée pour la stocker"
			return imagejpeg($destination, $newFile . '.jpg');
		}

		public function deleteImg($id){
			$folder = "tmp/article/" . $id;
			if (file_exists($folder)) {
				$directory = opendir($folder); // On définit le répertoire dans lequel on souhaite travailler.

				while (false !== ($file = readdir($directory))) {// On lit chaque fichier du répertoire dans la boucle.
				$path = $folder."/".$file; // On définit le chemin du fichier à effacer.
				// Si le fichier n'est pas un répertoire…
				if ($file != ".." AND $file != "." AND !is_dir($file)){
				       unlink($path); // On efface.
				       }
				}
				closedir($directory); //on ferme le repertoire...
				//...et on le supprime
				rmdir($folder);
			}			

		}


	}





?>
