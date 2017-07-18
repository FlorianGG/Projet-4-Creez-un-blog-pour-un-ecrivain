<?php 
	namespace SRC\model;
	
	class Biography{

		//fonction getters
		public function getContent(){
			$content = file_get_contents('web/txt/biography.txt');
			return $content;
		}
		
		//fonctions setters
		public function setContent($content){
			$content = htmlspecialchars_decode($content);
			$executeIsOk =  file_put_contents('web/txt/biography.txt', $content, LOCK_EX);
			if ($executeIsOk) {
				return true;
			}else{
				return false;
			}
		}
	}
?>
