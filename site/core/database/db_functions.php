<?php
/*
    db_functions.php
    
    Ce fichier définies des fonctions utiles pour gérer la base de données (ouverture, fermeture, ...).
    Il puise sa configuration dans le fichier de configuration "config.php".
*/


// On inclut la configuration
include_once('../includes/config.php');
include_once('../database/Profil.php');
include_once('../database/Recherche.php');
include_once('../database/Refuge.php');
include_once('../database/Type.php');
include_once('../database/User.php');


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

    $db_prepared_insert_compte->execute();
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
    return new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);

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
    $db_prepared_get_profile = $bdd->prepare('SELECT idProfil, nom, prenom, descPhysique, localisation, telephone, Refuge_idRefugen, User_idUser FROM PROFIL WHERE User_idUser = ?');
    $db_prepared_get_profile->execute(array($user->getIdUser()));
    $arr = array();
    while($row = $db_prepared_get_profile->fetch())
    {
       $arr[] = 
            new Profil($row['idProfil'], $row['nom'], $row['prenom'],  $row['descPhysique'], $row['localisation'], $row['telephone'], $row['Refuge_idRefugen'], $row['User_idUser']);
    }   
    return $arr;
}

function db_getSearchProfile($nom, $prenom, $localisation, $telephone)
{
    $request = 'SELECT idProfil, nom, prenom, descPhysique, localisation, telephone, Refuge_idRefugen, User_idUser FROM PROFIL WHERE';
    $arr_args;
    if(!is_null($nom))
    {
        $request = $request . 'nom LIKE ? AND';
        $arr_args[] = '%' . $nom . '%';
    }
    if(!is_null($prenom))
    {
        $request = $request . 'prenom LIKE ? AND';
        $arr_args[] = '%' . $prenom . '%';
    }
    if(!is_null($localisation))
    {
        $request = $request . 'localisation LIKE ? AND';
        $arr_args[] = '%' . $localisation . '%';
    }
    if(!is_null($telephone))
    {
        $request = $request . 'telephone LIKE ? AND';
        $arr_args[] = '%' . $telephone . '%';
    }
    $request = $request . '1 = 1 LIMIT 10';

    $db_prepared_get_search_profile = $bdd->prepare(request);
    $db_prepared_get_profile->execute($arr_args);
    $arr_ret = array();

    while($row = $db_prepared_get_profile->fetch())
    {
       $arr_ret[] = 
            new Profil($row['idProfil'], $row['nom'], $row['prenom'],  $row['descPhysique'], $row['localisation'], $row['telephone'], $row['Refuge_idRefugen'], $row['User_idUser']);
    }   

    return $arr_ret;
}

function db_getUserFromProfile($profil)
{
    $db_prepared_get_user = $bdd->prepare('SELECT id, login, pwd, email, Refuge_idRefuge, Type_idType  FROM USER WHERE idUser = ?');
    $db_prepared_get_user->execute(array($profil->getIdUser()));
    $row = $db_prepared_get_profile_count>fetch(); 
    return new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);   
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
