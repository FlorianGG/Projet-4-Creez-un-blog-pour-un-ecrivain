<?php
	namespace OCProjet4\model;

	use Symfony\Component\Yaml\Yaml;

	abstract class AuthAbstract
	{
		protected $bdd;
		protected $person;
		protected $personId;

		//function constructeur
		public function __construct(){
			$array = Yaml::parse(file_get_contents('config.yml'));
			$host = Yaml::dump($array['dbConnect']['host'], 1);
			$login = Yaml::dump($array['dbConnect']['loginDB'], 1);
			$pass = Yaml::dump($array['dbConnect']['passDB'], 1);
			$dbName = Yaml::dump($array['dbConnect']['dbname'], 1);
			try {
				$this->bdd = new \PDO('mysql:host=' . $host .';dbname=' . $dbName . ';charset=utf8;', $login, $pass, array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
			} catch (\Exception $e) {
				throw new \Exception('Erreur de connection à la base de donnée');
				
			}
		}

		public function login($pseudo, $pass){
			$person = $this->person->readByPseudo($pseudo);
			if(!is_null($person)){
				$passhash = password_verify($pass, $person->getPass());
				if ($passhash === true) {
					$_SESSION[$this->personId] = $person->getId();
					$_SESSION['pseudo'] = $person->getPseudo();
					return true;
				}	
			}
			return false;
		} 

		public function logged(){
			return isset($_SESSION[$this->personId]) && !is_null($_SESSION[$this->personId]);
		}

	}
