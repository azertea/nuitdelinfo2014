<?php

	/**
	 * Classe correspondante à un type de profil utilisateur (ONG, Public)
	 * @author Yseult B., Malik I.
	 */
	class Type
	{
		/* ******************************************************
		 * 	Attributs
		 * ******************************************************/
		public $idType;
		public $libelle;

		public function __construct($idType, $libelle) {
			$this->idType = $idType;
			$this->libelle = $libelle;
		}


		/* ******************************************************
		 * 	Getters
		 * ******************************************************/
		public function getIdType() {
			return $this->idType;
		}

		public function getLibelle() {
			return $this->libelle;
		}


		/* ******************************************************
		 * 	Setters
		 * ******************************************************/
		public function setLibelle($libelle) {
			$this->libelle = $libelle;
		}
	}

?>