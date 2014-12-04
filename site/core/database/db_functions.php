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
$bdd;
function db_open() {
    try {
        $bdd = new PDO('mysql:host=' . $DB_SRV_HOSTNAME . ';dbname=' . $DB_CRD_DATABASE_NAME . ';port=' . $DB_SRV_PORT, $DB_CRD_USERNAME, $DB_CRD_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      throw new Exception('Impossible d\'ouvrir la base de données : ' . $e->getMessage());
    }
}

function db_createAccount($login, $crypted_pass, $mail)
{
    Utilisateur $user;
    $db_prepared_insert_compte = $bdd->prepare('INSERT INTO USER (login, pwd, email) VALUES (:login, :pwd, :email)');

    $db_prepared_insert_compte->bindParam(':login', $login);
    $db_prepared_insert_compte->bindParam(':pwd', $pwd);
    $db_prepared_insert_compte->bindParam(':email', $email);

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
    Utilisateur $user = NULL;
    $db_prepared_get_user_from_id = $bdd->prepare('SELECT id, login, pwd, email, Refuge_idRefuge, Type_idType FROM USER WHERE login = ?');  
    $db_prepared_get_user_from_id->execute(array($login));
    $row = $db_prepared_get_user_from_id->fetch(); 
    $user = new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);
    return $user;
}

function db_createProfile($user, $nom, $prenom, $description, $localisation, $telephone)
{

    $db_prepared_insert_profile = $bdd->prepare('INSERT INTO PROFIL (nom, prenom, descPhysique, localisation, telephone, User_idUserPublic) VALUES (:nom, :prenom, :descPhysique, :localisation, :telephone, :User_idUserPublic)');

    $db_prepared_insert_profile->bindParam(':nom', $nom);
    $db_prepared_insert_profile->bindParam(':prenom', $prenom);
    $db_prepared_insert_profile->bindParam(':descPhysique', $description);
    $db_prepared_insert_profile->bindParam(':localisation', $localisation);
    $db_prepared_insert_profile->bindParam(':telephone', $telephone);
    $db_prepared_insert_profile->bindParam(':User_idUserPublic', $user->getIdUser());

    $db_prepared_insert_profile->execute();
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
