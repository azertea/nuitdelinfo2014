<?php

	/**
	 * Classe correspondante à un profil utilisateur
	 * @author Yseult B., Malik I.
	 */
	class Profil
	{

		/* ******************************************************
		 * 	Attributs
		 * ******************************************************/
		public $idProfil;
		public $nom;
		public $prenom;
		public $descPhysique;
		public $localisation;
		public $telephone;
		public $idRefuge;
		public $idUser;


		public function __construct($idProfil, $nom, $prenom,
									$descPhysique, $localisation,
									$telephone, $idRefuge, $idUser) {
			$this->idProfil = $idProfil;
			$this->nom = $nom;
			$this->prenom = $prenom;
			$this->descPhysique = $descPhysique;
			$this->localisation = $localisation;
			$this->telephone = $telephone;
			$this->idRefuge = $idRefuge;
			$this->idUser = $idUser;
		}


		/* ******************************************************
		 * 	Getters
		 * ******************************************************/

		public function getIdProfil() {
			return $this->idProfil;
		}

		public function getNom() {
			return $this->nom;
		}

		public function getPrenom() {
			return $this->prenom;
		}

		public function getDescPhysique() {
			return $this->descPhysique;
		}

		public function getLocalisation() {
			return $this->localisation;
		}

		public function getTelephone() {
			return $this->telephone;
		}

		public function getIdRefuge() {
			return $this->idRefuge;
		}

		public function getIdUser() {
			return $this->idUser;
		}



		/* ******************************************************
		 * 	Setters
		 * ******************************************************/

		public function setNom($nom) {
			$this->nom = $nom;
		}

		public function setPrenom($prenom) {
			$this->prenom = $prenom;
		}

		public function setDescPhysique($descPhysique) {
			$this->descPhysique = $descPhysique;
		}

		public function setLocalisation($localisation) {
			$this->localisation = $localisation;
		}

		public function setTelephone($telephone) {
			$this->telephone = $telephone;
		}

		public function setIdRefuge($idRefuge) {
			$this->idRefuge = $idRefuge;
		}

		public function setIdUser($idUser) {
			$this->idUser = $idUser;
		}

	}
?>