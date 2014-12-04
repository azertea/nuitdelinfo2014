<?php
/**

    config.php
    Ce fichier contient toute la configuration de base du site (identifiants de base de données, ...).

**/

$DB_SRV_HOSTNAME = "127.0.0.1";
$DB_SRV_PORT = "8081";
$DB_CRD_USER = "ndl2014";
$DB_CRD_PASSWORD = "azertea!2014";


/** 
	Déclaration des types pour le routage de l'API vers les Services

**/

$ROUTE_USER_PUBLIC = 0;
$ROUTE_USER_ONG = 1;
$ROUTE_SEARCH = 2;
$ROUTE_METHOD_ADD = 10;
$ROUTE_METHOD_GET = 20;
$ROUTE_METHOD_DEL = 30;
$ROUTE_METHOD_ALTER = 40;


 ?>