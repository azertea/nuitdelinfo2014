<?php
/*
    db_functions.php
    
    Ce fichier définies des fonctions utiles pour gérer la base de données (ouverture, fermeture, ...).
    Il puise sa configuration dans le fichier de configuration "config.php".
*/


// On inclut la configuration
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/includes/config.php');
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/database/Profil.php');
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/database/Recherche.php');
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/database/Refuge.php');
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/database/Type.php');
include_once($_SERVER["DOCUMENT_ROOT"] . 'core/database/User.php');


/*
    Cette fonction ouvre la base de données et retourne l'objet représentant la connexion.
*/
$bdd;
function db_open() {
    try {
        $bdd = new PDO('mysql:host=' . $DB_SRV_HOSTNAME . ';dbname=' . $DB_CRD_DATABASE_NAME . ';port=' . $DB_SRV_PORT, $DB_CRD_USERNAME, $DB_CRD_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      throw new Exception('Impossible d\'ouvrir la base de données : ' . $e->getMessage());
    }
}

function db_createAccount($login, $pwd, $mail)
{

    $db_prepared_insert_compte = $bdd->prepare('INSERT INTO USER (login, pwd, email) VALUES (:login, :pwd, :email)');

    $db_prepared_insert_compte->bindParam(':login', $login);
    $db_prepared_insert_compte->bindParam(':pwd', $pwd);
    $db_prepared_insert_compte->bindParam(':email', $mail);

    $db_prepared_insert_compte->execute()
    $user = db_getUserFromLogin($login);
    
    if(is_null($user))
    {
        throw new Exception('Utilisateur ' . $login .' impossible a creer');
    }

    return $user;
}

function db_getUserFromLogin($login)
{

    $db_prepared_get_user_from_id = $bdd->prepare('SELECT id, login, pwd, email, Refuge_idRefuge, Type_idType FROM USER WHERE login = ?');  
    $db_prepared_get_user_from_id->execute(array($login));
    $row = $db_prepared_get_user_from_id->fetch(); 
    $user = new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);
    return $user;
}

function db_createProfile($user, $nom, $prenom, $description, $localisation, $telephone)
{

    $db_prepared_insert_profile = $bdd->prepare('INSERT INTO PROFIL (nom, prenom, descPhysique, localisation, telephone, User_idUser) VALUES (:nom, :prenom, :descPhysique, :localisation, :telephone, :User_idUser)');

    $db_prepared_insert_profile->bindParam(':nom', $nom);
    $db_prepared_insert_profile->bindParam(':prenom', $prenom);
    $db_prepared_insert_profile->bindParam(':descPhysique', $description);
    $db_prepared_insert_profile->bindParam(':localisation', $localisation);
    $db_prepared_insert_profile->bindParam(':telephone', $telephone);
    $db_prepared_insert_profile->bindParam(':User_idUser', $user->getIdUser());

    $db_prepared_insert_profile->execute();
}



function db_nbProfileFromUser($user)
{
    $db_prepared_get_profile_count = $bdd->prepare('SELECT COUNT(idProfil) AS nb FROM PROFIL WHERE User_idUser = ?');
    $db_prepared_get_profile_count->execute(array($user->getIdUser()));
    $row = $db_prepared_get_profile_count>fetch(); 
    return $row['nb'];
}

function db_getProfileFromUser($user)
{
    $db_prepared_get_profile = $bdd->prepare('SELECT idProfil, nom, prenom, descPhysique, localisation, telephone, Refuge_idRefugen, User_idUser AS nb FROM PROFIL WHERE User_idUser = ?');
    $db_prepared_get_profile->execute(array($user->getIdUser()));
    $arr = new array();
    while($row = $db_prepared_get_profile->fetch())
    {
       $arr[] = 
            new Profil($row['idProfil'], $row['nom'], $row['prenom'],  $row['descPhysique'], $row['localisation'], $row['telephone'], $row['Refuge_idRefugen'], $row['User_idUser']);
    }   

}
/*
    Cette fonction ferme la base de données (passée en paramètre).
*/
function db_close() {
    try {
        return $bdd->closeCursor();
    
    } catch (Exception $e) {
        throw new Exception('Impossible de fermer la base de données : ' . $e->getMessage());
    }
}


?>
