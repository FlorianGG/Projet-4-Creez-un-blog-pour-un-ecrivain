<?php
	namespace SRC\model;

	use SRC\model\manager\UserManager;
	

	class User extends ModelPersonAbstract{
		protected $id;
		protected $pseudo;
		protected $email;
		protected $pass;

		//fonction constructeur
		public function __construct(array $data = null){
			$this->hydrate($data);
			$this->manager = new UserManager;
		}
	}
?>
