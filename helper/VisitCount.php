<?php 
	namespace helper;

	class VisitCount{
		public function countVisitor(){
			if (!isset($_SESSION['visit'])) {
				$_SESSION['visit'] = 'oui';
				$file = fopen('tmp/txt/counter.txt','r+');
				$nb = fgets($file, 4096);
				$nb = (int) $nb;
				$nb += 1;
				fseek($file,0);
				fputs($file, $nb);
				fclose($file);
			}
		}

		public function getNb(){
			$file = fopen('tmp/txt/counter.txt','r+');
			$nb = fgets($file, 4096);
			fclose($file);
			return $nb;
		}
	}

?>
