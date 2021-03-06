<?php

	/**
	 * Classe correspondante à un utilisateur pouvant se connecter
	 * @author Yseult B., Malik I.
	 */
	class User
	{
		/* ******************************************************
		 * 	Attributs
		 * ******************************************************/
		public $idUser;
		public $login;
		public $pwd;
		public $email;
		public $idRefuge;
		public $idType;


		public function __construct($idUser, $login, $pwd, 
									$email, $idRefuge, $idType) {
			$this->idUser = $idUser;
			$this->login = $login;
			$this->pwd = $pwd;
			$this->email = $email;
			$this->idRefuge = $idRefuge;
			$this->idType = $idType;
		}


		/* ******************************************************
		 * 	Getters
		 * ******************************************************/
		public function getIdUser() {
			return $this->idUser;
		}

		public function getLogin() {
			return $this->login;
		}

		public function getPwd() {
			return $this->pwd;
		}

		public function getEmail() {
			return $this->email;
		}

		public function getIdRefuge() {
			return $this->idRefuge;
		}

		public function getIdType() {
			return $this->idType;
		}


		/* ******************************************************
		 * 	Setters
		 * ******************************************************/
		public function setPwd($pwd) {
			$this->pwd = $pwd;
		}

		public function setEmail($email) {
			$this->email = $email;
		}

		public function setIdRefuge($idRefuge) {
			$this->idRefuge = $idRefuge;
		}

		public function setIdType($idType) {
			$this->idType = $idType;
		}
	}

?>