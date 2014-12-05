<?php 
session_start();

include_once('../database/db_functions.php');
include_once('../includes/config.php');
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
	$user;

	if (empty($login)) {
		return SER_ERR_LOGIN;
	}

	if ($pass1 != $pass2 || empty($pass1)) {
		return SER_ERR_PASS;
	}

	if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		return SER_ERR_MAIL;
	}

	try {
		$bdd = db_open();
		$user = db_createAccount($bdd,$login,sha1($pass1),$mail);
		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return SER_VALID;
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
		return SER_ERR_NOM;
	} 

	if (empty($prenom)) {
		return SER_ERR_PRENOM;
	} 

	if (empty($desc)) {
		return SER_ERR_DESC;
	} 

	if (empty($localisation)) {
		return SER_ERR_LOCALISATION;
	} 

	if (empty($telephone)) {
		return SER_ERR_PHONE;
	}

	$user = $_SESSION['user'];

	try {
		$bdd = db_open();
		db_createProfile($bdd,$user, $nom, $prenom, $desc, $localisation, $telephone);
		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	return SER_VALID;
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
	$user;

	if (empty($login)) {
		return SER_ERR_LOGIN;
	}

	if (empty($pass)) {
		return SER_ERR_PASS;
	}

	try {
		$bdd = db_open();
		$user = db_getUserFromLogin($bdd,$login);
		db_close($bdd);

		if (is_null($user)) {
			return SER_ERR_USER_NOT_FOUND;
		}

		if ($user->getIdType() != TYPE_USER_PUBLIC) {
			return SER_ERR_USER_WRONG_TYPE;
		}

		if ($user->getPwd() != sha1($pass)) {
			return SER_ERR_USER_WRONG_PWD;
		}
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return SER_VALID;
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
	$user;

	if (empty($login)) {
		return SER_ERR_LOGIN;
	}

	if (empty($pass)) {
		return SER_ERR_PASS;
	}

	try {
		$bdd = db_open();
		$user = db_getUserFromLogin($bdd,$login);
		db_close($bdd);

		if (is_null($user)) {
			return SER_ERR_USER_NOT_FOUND;
		}

		if ($user->getIdType() != TYPE_USER_ONG) {
			return SER_ERR_USER_WRONG_TYPE;
		}

		if ($user->getPwd() != sha1($pass)) {
			return SER_ERR_USER_WRONG_PWD;
		}
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	$_SESSION['user'] = $user;

	return SER_VALID;
}

// Retourne
//  - true si connecté
function serv_estConnecte()
{
	return isset($_SESSION['user']);
}

function serv_seDeconnecter()
{
	unset($_SESSION['user']);
}

// retourne
//  - (SER_ERR_DB) si problème avec la base
//  - vrai si c'est un Utilisateur ONG ou si c'est un Utilisateur Public qui n'a pas encore crée son profil
function serv_peutAjouterProfil()
{
	$user = $_SESSION['user'];
	$nbProfile = 0;

	if ($user->getIdType() == TYPE_USER_ONG) {
		return SER_VALID;
	}

	try {
		$bdd = db_open();
		$nbProfile = db_nbProfileFromUser($bdd,$user);
		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	return $nbProfile < 1;
}

// Retourne :
//  - (SER_ERR_DB) si problème avec la base
//  - la liste des profils pour l'utilisateur connecté
function serv_listeProfil()
{
	$listProfile = array();

	try {
		$bdd = db_open();
		$listProfile = db_getProfileFromUser($bdd,$user);
		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	return $listProfile;
}

// Retourne :
//  - (SER_ERR_EMPTY_PARAM_SEARCH) si tous les champs sont vides
//  - (SER_ERR_DB) si problème avec la base
//  - Le nombre de personnes quiont étés contactées suite à la recherche
function serv_rechercheProfilPublic($nom, $prenom, $desc, $localisation, $telephone)
{
	$listProfile = array();
	$listMail = array();

	if (empty($nom) && empty($prenom) && empty($desc) && empty($localisation) && empty($telephone)) {
		return SER_ERR_EMPTY_PARAM_SEARCH;
	}

	try {
		$bdd = db_open();
		$listProfile = db_getSearchProfile($bdd, $nom, $prenom, $desc, $localisation, $telephone);

		// Contacter la liste des personnes
		foreach ($listProfile as $key => $profil) {
			$user = db_getUserFromProfile($bdd,$profil);
			array_push($listMail, $user->getEmail());
		}

		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	// foreach ($listMail as $key => $mail) {
	// 	envoyerMailFromPublic($mail);
	// }

	return count($listProfile);
}

// Retourne :
//  - (SER_ERR_EMPTY_PARAM_SEARCH) si tous les champs sont vides
//  - (SER_ERR_DB) si problème avec la base
//  - La liste des profils contactés suite à la recherche
function serv_rechercheProfilONG($nom, $prenom, $desc, $localisation, $telephone)
{
	$listProfile = array();
	$listMail = array();

	if (empty($nom) && empty($prenom) && empty($desc) && empty($localisation) && empty($telephone)) {
		return SER_ERR_EMPTY_PARAM_SEARCH;
	}

	try {
		$bdd = db_open();
		$listProfile = db_getSearchProfile($bdd, $nom, $prenom, $desc, $localisation, $telephone);

		// Contacter la liste des personnes
		foreach ($listProfile as $key => $profil) {
			$user = db_getUserFromProfile($bdd,$profil);
			array_push($listMail, $user->getEmail());
		}

		db_close($bdd);
	} catch (Exception $e) {
		error_log(print_r($e, true));
		return SER_ERR_DB;
	}

	// foreach ($listMail as $key => $mail) {
	// 	envoyerMailFromONG($mail);
	// }

	return $listProfile;
}

//////////////////////////////////////////
/////////// Fonctions privées ////////////
//////////////////////////////////////////

function envoyerMailFromPublic($mailDest)
{
	$user = $_SESSION['user'];
	$mailSource = $user->getEmail();

	$content = "un utilisateur public (" . $mailSource . ") vous a recherché.";
	envoyerMail($content, $mailDest);
}

function envoyerMailFromONG($mailDest)
{
	$user = $_SESSION['user'];
	$mailSource = $user->getEmail();

	$content = "une ONG (" . $mailSource . ") vous a recherché.";
	envoyerMail($content, $mailDest);
}

function envoyerMail($content, $mailDest)
{
	$user = $_SESSION['user'];
	$mailSource = $user->getEmail();
	$loginSource = $user->getLogin();
	
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailDest)) // On filtre les serveurs qui présentent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = "Bonjour, " . $content;
	$message_html = "<html><head></head><body><b>Bonjour</b>, " . $content. ".</body></html>";
	//==========

	//=====Création de la boundary.
	$boundary = "-----=".md5(rand());
	$boundary_alt = "-----=".md5(rand());
	//==========
	 
	//=====Définition du sujet.
	$sujet = "Recherché par " . $mailSource;
	//=========
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"" . $loginSource . "\" <" . $mailSource . ">" . $passage_ligne;
	$header.= "Reply-to: \"" . $loginSource . "\" <" . $mailSource . ">" . $passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	 
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	 
	//=====Ajout du message au format HTML.
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	 
	//=====On ferme la boundary alternative.
	$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
	//==========
	 
	 
	 
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	 
	//=====Envoi de l'e-mail.
	mail($mailDest, $sujet, $message, $header);
}
?>