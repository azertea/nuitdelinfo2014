<?php
/*
    db_functions.php
    
    Ce fichier définies des fonctions utiles pour gérer la base de données (ouverture, fermeture, accès).
    Il puise sa configuration dans le fichier de configuration "config.php".
*/


// On inclut la configuration et les classes métiers
include_once('../includes/config.php');
include_once('../database/Profil.php');
include_once('../database/Recherche.php');
include_once('../database/Refuge.php');
include_once('../database/Type.php');
include_once('../database/User.php');


/*
    Représente la connexion à la base de donnée, utilisée en interne.
    Il faut l'initialiser en utilisant db_open et la fermer avec db_close,
    a chaque fois que l'on utilise une fonction d'accès
*/
/*
    Cette fonction ouvre la base de données, la bdd est stockée en local
*/
function db_open() {
    try {
        $bdd = new PDO('mysql:host=' . DB_SRV_HOSTNAME . ';dbname=' . DB_CRD_DATABASE_NAME . ';port=' . DB_SRV_PORT, DB_CRD_USER, DB_CRD_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (Exception $e) {
      throw new Exception('Impossible d\'ouvrir la base de données : ' . $e->getMessage());
    }
}

/*
    Permet d'ajouter un compte a partir du login, mot de passe et e-mail dans la BDD
*/
function db_createAccount($bdd, $login, $pwd, $mail)
{
    //Creation du preparedStatement
    $db_prepared_insert_compte = $bdd->prepare('INSERT INTO USER (login, pwd, email) VALUES (:login, :pwd, :email)');

    //Ajout des attributs
    $db_prepared_insert_compte->bindParam(':login', $login);
    $db_prepared_insert_compte->bindParam(':pwd', $pwd);
    $db_prepared_insert_compte->bindParam(':email', $mail);

    //Execution de la requete
    $db_prepared_insert_compte->execute();

    //On récupère l'utilisateur inseré
    $user = db_getUserFromLogin($login);
    
    if(is_null($user))
    {
        throw new Exception('Utilisateur ' . $login .' impossible a creer');
    }

    return $user;
}

/*
    Permet de récuperer un utilisateur de la BDD en fonction de son login
*/
function db_getUserFromLogin($bdd, $login)
{

    $db_prepared_get_user_from_id = $bdd->prepare('SELECT id, login, pwd, email, Refuge_idRefuge, Type_idType FROM USER WHERE login = ?');  
    $db_prepared_get_user_from_id->execute(array($login));

    //On fetch les données et on construit l'utilisateur en fonction des attributs
    $row = $db_prepared_get_user_from_id->fetch(); 
    return new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);

}

/*
    Permet de créer un profil dans la BDD à partir d'un utilisateur (pour son id)
    d'un nom, d'un prenom, d'une description, d'une localisation et d'un numero de téléphone
*/
function db_createProfile($bdd, $user, $nom, $prenom, $description, $localisation, $telephone)
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


/*
    Compte le nombre de créés par l'utilisateur passé en paramètre
*/
function db_nbProfileFromUser($bdd, $user)
{
    $db_prepared_get_profile_count = $bdd->prepare('SELECT COUNT(idProfil) AS nb FROM PROFIL WHERE User_idUser = ?');
    $db_prepared_get_profile_count->execute(array($user->getIdUser()));

    $row = $db_prepared_get_profile_count>fetch(); 
    return $row['nb'];
}

/*
    Donne la liste des profils créés par l'utilisateur passé en paramètre
*/
function db_getProfileFromUser($bdd, $user)
{
    $db_prepared_get_profile = $bdd->prepare('SELECT idProfil, nom, prenom, descPhysique, localisation, telephone, Refuge_idRefugen, User_idUser FROM PROFIL WHERE User_idUser = ?');
    $db_prepared_get_profile->execute(array($user->getIdUser()));

    //On fetch en boucle en ajoutant les Profil récupérés de la BDD dans le tableau créé
    $arr = array();
    while($row = $db_prepared_get_profile->fetch())
    {
       $arr[] = 
            new Profil($row['idProfil'], $row['nom'], $row['prenom'],  $row['descPhysique'], $row['localisation'], $row['telephone'], $row['Refuge_idRefugen'], $row['User_idUser']);
    }   
    
    return $arr;
}

/*
    Permet de rechercher les 10 premières occurences de profils correspondant aux
    nom, prénom, à la localisation et au numéro de téléphone passé en paramètres.
    (Ils peuvent être nuls mais au moins un ne l'est pas)
*/
function db_getSearchProfile($bdd, $nom, $prenom, $localisation, $telephone)
{
    //On initialise la string de la requête sans les conditions
    $request = 'SELECT idProfil, nom, prenom, descPhysique, localisation, telephone, Refuge_idRefugen, User_idUser FROM PROFIL WHERE';
    $arr_args;
    
    //On vérifie pour chaque argument s'il existe
    //Pour le rajouter à la condition de requête et dans les tableau d'arguments
    if(!is_null($nom))
    {
        $request = $request . 'UPPER(nom) LIKE UPPER(?) AND';
        $arr_args[] = '%' . $nom . '%';
    }
    
    if(!is_null($prenom))
    {
        $request = $request . 'UPPER(prenom) LIKE UPPER(?) AND';
        $arr_args[] = '%' . $prenom . '%';
    }
    
    if(!is_null($localisation))
    {
        $request = $request . 'UPPER(localisation) LIKE UPPER(?) AND';
        $arr_args[] = '%' . $localisation . '%';
    }
    
    if(!is_null($telephone))
    {
        $request = $request . 'UPPER(telephone) LIKE UPPER(?) AND';
        $arr_args[] = '%' . $telephone . '%';
    }
    
    //On termine la requete avec 1=1 (on avait un AND, il faut une dernière condition)
    $request = $request . '1 = 1 LIMIT 10';

    //Execution de la requête concatenée avec les arguments
    $db_prepared_get_search_profile = $bdd->prepare($request);
    $db_prepared_get_profile->execute($arr_args);
   
    $arr_ret = array();

    while($row = $db_prepared_get_profile->fetch())
    {
       $arr_ret[] = 
            new Profil($row['idProfil'], $row['nom'], $row['prenom'],  $row['descPhysique'], $row['localisation'], $row['telephone'], $row['Refuge_idRefugen'], $row['User_idUser']);
    }   

    return $arr_ret;
}

/*
    Renvoi l'utilisateur qui a créé le profil passé en paramètre
*/
function db_getUserFromProfile($bdd, $profil)
{
    $db_prepared_get_user = $bdd->prepare('SELECT id, login, pwd, email, Refuge_idRefuge, Type_idType  FROM USER WHERE idUser = ?');
    $db_prepared_get_user->execute(array($profil->getIdUser()));

    $row = $db_prepared_get_profile_count>fetch(); 
    return new Utilisateur($row['id'], $row['login'], $row['pwd'], $row['email'], $row['Refuge_idRefuge'], $row['Type_idType']);   
}

/*
    Cette fonction ferme la base de données.
*/
function db_close($bdd) {
    try {
        return $bdd->closeCursor();
    
    } catch (Exception $e) {
        throw new Exception('Impossible de fermer la base de données : ' . $e->getMessage());
    }
}


?>
