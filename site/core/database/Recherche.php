<?php

	/**
	 * Classe correspondante à une recherche de mots-clefs par un utilisateur
	 * @author Yseult B., Malik I.
	 */

	/* ******************************************************
	 * 	Attributs
	 * ******************************************************/
	private idRecherche;
	private keywordDesc;
	private keywordLoc;
	private userId;


	public function __construct($idRecherche, $keywordDesc,
								$keywordLoc, $userId) {
		$this->idRecherche = $idRecherche;
		$this->keywordDesc = $keywordDesc;
		$this->keywordLoc = $keywordLoc;
		$this->userId = $userId;
	}


	/* ******************************************************
	 * 	Getters
	 * ******************************************************/
	public function getIdRecherche() {
		return $this->idRecherche;
	}

	public function getKeywordDesc() {
		return $this->keywordDesc;
	}

	public function getKeywordLoc() {
		return $this->keywordLoc;
	}

	public function getUserId() {
		return $this->userId;
	}

	/* ******************************************************
	 * 	Setters
	 * ******************************************************/
	public function setKeywordDesc($keywordDesc) {
		$this->keywordDesc = $keywordDesc;
	}

	public function setKeywordLoc($keywordLoc) {
		$this->keywordLoc = $keywordLoc;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}



?>