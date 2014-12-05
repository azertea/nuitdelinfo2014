<?php 
session_start();

include_once('/core/database/db_functions.php');
include_once('/core/includes/config.php');
/*


- Modifier profil

- Faire une recherche de public de la part d'un public : envoie une notif à ceux concernés
- Faire une recherche de public de la part d'une ONG : envoie une notif à ceux concernés


*/

// Retourne
//  - true si crée
//  - (SER_ERR_DB) si problème de création en base (base indisponible, utilisateur existant)
//  - (SER_ERR_LOGIN) si login invalide
//  - (SER_ERR_PASS) si mots de passe invalides
//  - (SER_ERR_MAIL) si mail invalide
function serv_creerCompte($login, $pass1, $pass2, $mail)
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
function serv_creerProfil($nom, $prenom, $desc, $localisation, $telephone)
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
//  - (SER_ERR_USER_NOT_FOUND) Utilisateur inconnu
//  - (SER_ERR_USER_WRONG_TYPE) Utilisateur de mauvais type (pas public)
//  - (SER_ERR_USER_WRONG_PWD) Mauvais mot de passe
function serv_connecterComptePublic($login, $pass)
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
		$user = db_getUser($login);
		db_close();

		if (is_null($user)) {
			return $SER_ERR_USER_NOT_FOUND;
		}

		if ($user->getIdType() != $TYPE_USER_PUBLIC) {
			return $SER_ERR_USER_WRONG_TYPE;
		}

		if ($user->getPwd() != sha1($pass)) {
			return $SER_ERR_USER_WRONG_PWD;
		}
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return true;
}

// Retourne
//  - true si connecté
//  - (SER_ERR_DB) si problème de connexion ou problème avec la base
//  - (SER_ERR_LOGIN) si login invalide
//  - (SER_ERR_PASS) si pass invalide
//  - (SER_ERR_USER_NOT_FOUND) Utilisateur inconnu
//  - (SER_ERR_USER_WRONG_TYPE) Utilisateur de mauvais type (pas public)
//  - (SER_ERR_USER_WRONG_PWD) Mauvais mot de passe
function serv_connecterCompteONG($login, $pass)
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
		$user = db_getUser($login);
		db_close();

		if (is_null($user)) {
			return $SER_ERR_USER_NOT_FOUND;
		}

		if ($user->getIdType() != $TYPE_USER_ONG) {
			return $SER_ERR_USER_WRONG_TYPE;
		}

		if ($user->getPwd() != sha1($pass)) {
			return $SER_ERR_USER_WRONG_PWD;
		}
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return true;
}

// Retourne
//  - true si connecté
function estConnecte()
{
	return isset($_SESSION['user']);
}

function seDeconnecter()
{
	unset($_SESSION['user']);
}

// retourne
//  - (SER_ERR_DB) si problème avec la base
//  - vrai si c'est un Utilisateur ONG ou si c'est un Utilisateur Public qui n'a pas encore crée son profil
function peutAjouterProfil()
{
	Utilisateur $user = $_SESSION['user'];
	$nbProfile = 0;

	if ($user->getIdType() == $TYPE_USER_ONG) {
		return true;
	}

	try {
		db_open();
		$nbProfile = db_nbProfileFromUser($user);
		db_close();
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	return $nbProfile < 1;
}

// Retourne :
//  - (SER_ERR_DB) si problème avec la base
//  - la liste des profils pour l'utilisateur connecté
function listeProfil()
{
	$listProfile = array();

	try {
		db_open();
		$listProfile = db_getProfilesFromUser($user);
		db_close();
	} catch (Exception $e) {
		return $SER_ERR_DB;
	}

	return $listProfile;
}

function rechercheProfil($keywordDesc, $keywordLoc)
{
	# code...
}

function serv_modificationProfil($new_nom, $new_prenom, $new_desc, $new_localisation, $new_telephone)
{

}
?>