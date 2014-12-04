<?php 
session_start();

include_once '/core/database/db_functions.php';
include_once '/core/includes/config.php';
/*
- Créer compte recherché

- Créer profil

- Se connecter public / Se connecter ONG

- Modifier profil

- Faire une recherche de public de la part d'un public : envoie une notif à ceux concernés
- Faire une recherche de public de la part d'une ONG : envoie une notif à ceux concernés

- Déconnexion

*/

// Retourne
//  - true si crée
//  - (SER_ERR_DB) si problème de création en base (base indisponible, utilisateur existant)
//  - (SER_ERR_LOGIN) si login invalide
//  - (SER_ERR_PASS) si mots de passe invalides
//  - (SER_ERR_MAIL) si mail invalide
public function serv_creerCompte($login, $pass1, $pass2, $mail)
{
	Utilisateur $user;

	if (empty($login)) {
		return $SER_ERR_LOGIN;
	}

	if ($pass1 != $pass2 || empty($pass1)) {
		return $SER_ERR_PASS;
	}

	if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		return $SER_ERR_MAIL;
	}

	try {
		db_open();
		$user = db_createAccount($login,sha1($pass1),$mail);
		db_close();
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return true;
}

// Retourne
//  - true si crée
//  - (SER_ERR_DB) si problème de création en base (base indisponible, problème lors de l'ajout)
//  - (SER_ERR_NOM) si $nom invalide
//  - (SER_ERR_PRENOM) si $prenom invalide
//  - (SER_ERR_DESC) si $desc invalide
//  - (SER_ERR_LOCALISATION) si $localisation invalide
//  - (SER_ERR_PHONE) si $telephone invalide
public function serv_creerProfil($nom, $prenom, $desc, $localisation, $telephone)
{
	if (empty($nom)) {
		return $SER_ERR_NOM;
	} 

	if (empty($prenom)) {
		return $SER_ERR_PRENOM;
	} 

	if (empty($desc)) {
		return $SER_ERR_DESC;
	} 

	if (empty($localisation)) {
		return $SER_ERR_LOCALISATION;
	} 

	if (empty($telephone)) {
		return $SER_ERR_PHONE;
	}

	Utilisateur $user = $_SESSION['user'];

	try {
		db_open();
		db_createProfile($user, $nom, $prenom, $desc, $localisation, $telephone);
		db_close();
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	return true;
}

// Retourne
//  - true si connecté
//  - (SER_ERR_DB) si problème de connexion ou problème avec la base
//  - (SER_ERR_LOGIN) si login invalide
//  - (SER_ERR_PASS) si pass invalide
public function serv_connecterComptePublic($login, $pass)
{
	Utilisateur $user;

	if (empty($login)) {
		return $SER_ERR_LOGIN;
	}

	if (empty($pass)) {
		return $SER_ERR_PASS;
	}

	try {
		db_open();
		$user = db_connectAccountPublic($login, sha1($pass));
		db_close();
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return true;
}


 ?>