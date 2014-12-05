<?php
/*

    config.php
    Ce fichier contient toute la configuration de base du site (identifiants de base de données", ...).

*/

define("DB_SRV_HOSTNAME", "192.168.0.104");
define("DB_SRV_PORT", "3306");
define("DB_CRD_USER", "ndl2014");
define("DB_CRD_PASSWORD", "azertea!2014");
define("DB_CRD_DATABASE_NAME", "nuitdelinfo2014");


/*
	Type d'utilisateur de base
*/
define("TYPE_USER_PUBLIC", 0);
define("TYPE_USER_ONG", 1);


/*
	Codes d'erreur
*/

define("SER_ERR_DB", -1);
define("SER_ERR_LOGIN", -2);
define("SER_ERR_PASS", -3);
define("SER_ERR_MAIL", -4);
define("SER_ERR_NOM", -5);
define("SER_ERR_PRENOM", -6);
define("SER_ERR_DESC", -7);
define("SER_ERR_LOCALISATION", -8);
define("SER_ERR_PHONE", -9);
define("SER_ERR_USER_NOT_FOUND", -10);
define("SER_ERR_USER_WRONG_TYPE", -11);
define("SER_ERR_USER_WRONG_PWD", -12);
define("SER_ERR_EMPTY_PARAM_SEARCH", -13);


/*
	Déclaration des types pour le routage de l'API vers les Services

*/

define("ROUTE_USER_PUBLIC", 0);
define("ROUTE_USER_ONG", 1);
define("ROUTE_SEARCH", 2);
define("ROUTE_PROFILE", 3);
define("ROUTE_METHOD_ADD", 10);
define("ROUTE_METHOD_CONNECT", 20);
define("ROUTE_METHOD_DEL", 30);
define("ROUTE_METHOD_ALTER", 40);
define("ROUTE_METHOD_DISCONNECT", 50);
define("ROUTE_METHOD_ISCONNECTED", 60);


 ?>