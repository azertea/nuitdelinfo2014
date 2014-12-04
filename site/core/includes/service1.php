<?php 
session_start();

include_once '/core/database/db_functions.php';
/*
- Créer compte recherché

- Créer profil

- Se connecter public / Se connecter ONG

- Faire une recherche de public de la part d'un public : envoie une notif à ceux concernés
- Faire une recherche de public de la part d'une ONG : envoie une notif à ceux concernés

- Déconnexion

*/

// Retourne
//  - true si crée
//  - (-1) si problème de création en base (base indisponible, utilisateur existant)
//  - (-2) si login invalide
//  - (-3) si mots de passe invalides
//  - (-4) si mail invalide
public function serv_creerCompte($login,$pass1,$pass2,$mail)
{
	Utilisateur $user;

	if (empty($login)) {
		return -12
	}

	if ($pass1 != $pass2 || empty($pass1)) {
		return -3;
	}

	if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		return -4;
	}

	try {
		db_open();
		$user = db_createAccount($login,sha1($pass1),$mail);
		db_close();

	} catch (Exception $e) {
		return -1;
	}

	$_SESSION['user'] = $user;

	return true;
}

// Retourne
// - true si crée
// - (-1) si problème de création en base (base indisponible, problème lors de l'ajout)
// - (-2) si $nom invalide
// - (-3) si $prenom invalide
// - (-4) si $desc invalide
// - (-5) si $localisation invalide
// - (-6) si $telephone invalide
public function serv_creerProfil($nom,$prenom,$desc,$localisation,$telephone)
{
	if (empty($nom)) {
		return -2;
	} 

	if (empty($prenom)) {
		return -3;
	} 

	if (empty($desc)) {
		return -4;
	} 

	if (empty($localisation)) {
		return -5;
	} 

	if (empty($telephone)) {
		return -6;
	}

	Utilisateur $user = $_SESSION['user'];

	try {

		db_create;
	} catch (Exception $e) {
		
	}
}

// Retourne le type du compte connecté (false si erreur)
public function serv_connecterCompte($login,$pass)
{
	
}


 ?>