<?php
/*

    config.php
    Ce fichier contient toute la configuration de base du site (identifiants de base de données, ...).

*/

$DB_SRV_HOSTNAME = "127.0.0.1";
$DB_SRV_PORT = "8081";
$DB_CRD_USER = "ndl2014";
$DB_CRD_PASSWORD = "azertea!2014";


/*
	Type d'utilisateur de base
*/
$TYPE_USER_PUBLIC = 0;
$TYPE_USER_ONG = 1;


/*
	Codes d'erreur
*/

$SER_ERR_DB = -1;
$SER_ERR_LOGIN = -2;
$SER_ERR_PASS = -3;
$SER_ERR_MAIL = -4;
$SER_ERR_NOM = -5;
$SER_ERR_PRENOM = -6;
$SER_ERR_DESC = -7;
$SER_ERR_LOCALISATION = -8;
$SER_ERR_PHONE = -9;
$SER_ERR_USER_NOT_FOUND = -10;
$SER_ERR_USER_WRONG_TYPE = -11;
$SER_ERR_USER_WRONG_PWD = -12;


/*
	Déclaration des types pour le routage de l'API vers les Services

*/

$ROUTE_USER_PUBLIC = 0;
$ROUTE_USER_ONG = 1;
$ROUTE_SEARCH = 2;
$ROUTE_PROFILE = 3;
$ROUTE_METHOD_ADD = 10;
$ROUTE_METHOD_CONNECT = 20;
$ROUTE_METHOD_DEL = 30;
$ROUTE_METHOD_ALTER = 40;
$ROUTE_METHOD_DISCONNECT = 50;
$ROUTE_METHOD_ISCONNECTED = 60;


 ?>