<?php 
	namespace OCProjet4\helper;

	class VisitCount{
		// fonction qui gère le compte de visiteur
		// l'inscrit dans un fichier txt
		public function countVisitor(){
			if (!isset($_SESSION['visit'])) {
				$_SESSION['visit'] = 'oui';
				$file = fopen('web/txt/counter.txt','r+');
				$nb = fgets($file, 4096);
				$nb = (int) $nb;
				$nb += 1;
				fseek($file,0);
				fputs($file, $nb);
				fclose($file);
			}
		}

		// fonction qui récupère le nombre d'utilisateur
		// en lisant dans le fichier txt
		public function getNb(){
			$file = fopen('web/txt/counter.txt','r+');
			$nb = fgets($file, 4096);
			fclose($file);
			return $nb;
		}
	}

?>
