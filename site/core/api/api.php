<?php
//error_reporting(E_ALL);
ini_set('display_errors','On');
/*Fichier aiguillage API */
include ("../includes/config.php");
require_once ("./api_functions.php");
require_once ("../includes/service.php");

/**

ROUTAGE 

**/
if( !isset($_GET['type']))
	  errorBadRequest("Missing Field(s)");

switch ($_GET['type']) {
	case ROUTE_USER_PUBLIC :
		handlerUserPublic();
		break;
	case ROUTE_USER_ONG :
		handlerUserONG();
		break;
	case ROUTE_SEARCH:
		handlerSearch();
		break;
	case ROUTE_PROFIL:
		handlerProfile();
		break;

}

/**

GESTION USER PUBLIC

*/

function handlerUserPublic(){
	
	switch ($_GET['method']) {
		case ROUTE_METHOD_ADD :
			methodAddUserPublic();			
		break;

		/*case $ROUTE_METHOD_DEL:
			methodDelUserPublic();
		break;*/

		case ROUTE_METHOD_ALTER:
			methodAlterUserPublic();
		break;

		case ROUTE_METHOD_CONNECT:
			methodConnectUserPublic();
		break;

		case ROUTE_METHOD_DISCONNECT:
		 	methodDisconnectUserPublic();
		break;

		case ROUTE_METHOD_ISCONNECTED:
		 	methodIsConnectedUserPublic();
		break;
		
		case ROUTE_METHOD_CAN_ADD:
			methodCanAddProfile();
		break;
		
		case ROUTE_METHOD_GET_PROFILE_LIST:
			methodGetListProfile();
		break;

	}
}

/*
*/
function methodAddUserPublic () {
	if (!isset($_POST['login']) || !isset($_POST['pwd1']) || !isset($_POST['pwd2']) || !isset($_POST['email']))
		errorBadRequest("Missing User Field(s)");
	
	
	switch(serv_creerCompte($_POST['login'],$_POST['pwd1'],$_POST['pwd2'], $_POST['email'])) {
		case SER_ERR_LOGIN : case $SER_ERR_PASS :  
			errorForbidden();
		break;
		case  SER_ERR_MAIL :
			errorNotAcceptable("Wrong Email");
		break;

		case SER_ERR_DB:
			errorInternal();
		break;
		
	}
}

/*function methodDelUserPublic(){
	if (!isset($_POST['id']))
		errorBadRequest("Missing ID Field");

		$return = //delUtilisateur
	
	switch(//delUtilisateur) {
		case :
		//
	}
}*/

/*function methodAlterUserPublic(){
	if (!isset($_POST['id']) || !isset($_POST['pwd1']) || !isset($_POST['pwd2']) || !isset($_POST['email']))
		errorBadRequest("Missing Field(s)");
	/*$return = //alterUser;
	
	switch($return) {
		case :
		//
	}

}*/

function methodConnectUserPublic() {
	if (!isset($_POST['login']) || !isset($_POST['pwd']))
		errorBadRequest("Missing Field(s)");

	switch(serv_connecterComptePublic($_POST['login'], $_POST['pwd'])) {
		
		case SER_ERR_LOGIN :
			errorForbidden();
		break;

		case SER_ERR_PASS :
			errorForbidden();
		break;
	}
}
 function methodIsConnectedUserPublic() {
 	echo(json_encode ((serv_estConnecte()) ? 1 : 0));
 }

 function methodDisconnectUserPublic(){
 	serv_seDeconnecter();
 }

/**

GESTION USER ONG

*/

function handlerUserONG(){
	switch ($_GET['method']) {
/*		case $ROUTE_METHOD_ADD:
			methodAddUserONG();			
		break;

		case $ROUTE_METHOD_DEL:
			methodDelUserONG();
		break;

		case $ROUTE_METHOD_ALTER:
			methodalterUserONG();
		break;
*/

		case ROUTE_METHOD_CONNECT:
			methodConnectUserONG();
		break;

		case ROUTE_METHOD_ISCONNECTED:
			methodIsConnectedUserONG();
		break;

		case ROUTE_METHOD_DISCONNECT:
			methodDisconnectUserONG();
		break;
		
		case ROUTE_METHOD_CAN_ADD:
			methodCanAddProfile();
		break;
		
		case ROUTE_METHOD_GET_PROFILE_LIST:
			methodGetListProfile();
		break;

	}	
}

function methodConnectUserONG(){
	if (!isset($_POST['login']) || !isset($_POST['pwd']))
		errorBadRequest("Missing Field(s)");

	switch(serv_connecterCompteONG($_POST['login'], $_POST['pwd'])) {
		
		case SER_ERR_LOGIN :
			errorForbidden();
		break;

		case SER_ERR_PASS :
			errorForbidden();
		break;
	}	

}

 function methodIsConnectedUserONG() {
 	echo (json_encode ((serv_estConnecte()) ? 1 : 0));
 }

 function methodDisconnectUserONG(){
 	serv_seDeconnecter();
 }

/**

GESTION PROFIL

**/
function handlerProfile() {
	switch ($_GET['method']) {
		case ROUTE_METHOD_ADD:
			methodAddProfile();			
		break;
		case ROUTE_METHOD_ALTER:
			methodAlterProfile();
		break;
	}	

}

function methodAddProfile() {
	if (!isset($_POST['name']) || !isset($_POST['forename']) || !isset($_POST['desc']) || !isset($_POST['loc']) || !isset($_POST['phone']))
		errorBadRequest("Missing User Field(s)");

	switch (serv_creerProfile($_POST['name'], $_POST['forename'], $_POST['desc'], $_POST['loc'], $_POST['phone'])) {
		case SER_ERR_NOM : case $SER_ERR_PRENOM : case $SER_ERR_DESC : case $SER_ERR_LOCALISATION : case $SER_ERR_PHONE :
			errorNotAcceptable("Wrong Field");
		break;

		case SER_ERR_DB : 
			errorInternal();
		break;
	}
}

function methodAlterProfile(){
	if (!isset($_POST['name']) || !isset($_POST['forename']) || !isset($_POST['desc']) || !isset($_POST['loc']) || !isset($_POST['phone']))
		errorBadRequest("Missing User Field(s)");
	/*TODO SWITCH*/
}

function methodCanAddProfile(){
	echo (json_encode((serv_peutAjouterProfil()) ? 1 : 0));
}

function methodGetListProfile(){
	echo (json_encode(serv_listeProfil()));
}

/**

GESTION RECHERCHE

**/
function handlerSearch(){
	switch ($_GET['user']) {
		case ROUTE_USER_ONG:
			userONGSearch();			
		break;
		case ROUTE_USER_PUBLIC:
			userPublicSearch();
		break;
	}	
}

function userPublicSearch(){
	if (!isset($_POST['name']) || !isset($_POST['forename']) || !isset($_POST['desc']) || !isset($_POST['loc']) || !isset($_POST['phone']))
		errorBadRequest("Missing User Field(s)");
	echo (json_encode(serv_rechercheProfilPublic($_POST['name'],$_POST['forename'],$_POST['desc'],$_POST['loc'],$_POST['phone'])));
}

function userONGSearch(){
	if (!isset($_POST['name']) || !isset($_POST['forename']) || !isset($_POST['desc']) || !isset($_POST['loc']) || !isset($_POST['phone']))
		errorBadRequest("Missing User Field(s)");
	echo(json_encode(serv_rechercheProfilONG($_POST['name'],$_POST['forename'],$_POST['desc'],$_POST['loc'],$_POST['phone'])));
}

?>