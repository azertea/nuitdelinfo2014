<?php
/*
    db_functions.php
    
    Ce fichier définies des fonctions utiles pour gérer la base de données (ouverture, fermeture, ...).
    Il puise sa configuration dans le fichier de configuration "config.php".
*/


// On inclut la configuration
include_once($_SERVER["DOCUMENT_ROOT"] . "core/includes/config.php");


/*
    Cette fonction ouvre la base de données et retourne l'objet représentant la connexion.
*/
function db_open() {
    try {
        return new PDO('mysql:host=' . $DB_SRV_HOSTNAME . ';dbname=' . $DB_CRD_DATABASE_NAME . ';port=' . $DB_SRV_PORT, $DB_CRD_USERNAME, $DB_CRD_PASSWORD);
    
    } catch (Exception $e) {
        die('Impossible d\'ouvrir la base de données : ' . $e->getMessage());
    }
}


/*
    Cette fonction ferme la base de données (passée en paramètre).
*/
function db_close($bdd) {
    try {
        return $bdd->closeCursor();
    
    } catch (Exception $e) {
        die('Impossible de fermer la base de données : ' . $e->getMessage());
    }
}


?>
