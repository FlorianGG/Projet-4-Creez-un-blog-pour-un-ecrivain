<?php 
	namespace OCProjet4\helper;

	class VisitCount{
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

		public function getNb(){
			$file = fopen('web/txt/counter.txt','r+');
			$nb = fgets($file, 4096);
			fclose($file);
			return $nb;
		}
	}

?>
