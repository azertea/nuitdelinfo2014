<?php
	/**
	 * Classe correspondante à un camp de réfugiés/une agence de l'ONG/...
	 * @author Yseult B., Malik I.
	 */
	class Recherche
	{
		/* ******************************************************
		 * 	Attributs
		 * ******************************************************/
		private idRefuge;
		private GPS;


		public function __construct($idRefuge, $GPS) {
			$this->idRefuge = $idRefuge;
			$this->GPS = $GPS;
		}


		/* ******************************************************
		 * 	Getters
		 * ******************************************************/
		public function getIdRefuge() {
			return $this->idRefuge;
		}

		public function getGPS() {
			return $this->GPS;
		}


		/* ******************************************************
		 * 	Setters
		 * ******************************************************/
		public function setGPS($GPS) {
			$this->GPS = $GPS;
		}
	}
?>