<?php
$DB_NAME = 'camagru';
$DB_USER = 'root';
$DB_PASSWORD = 'mthiery';
$DB_HOST ='localhost';

// connexion à Mysql sans base de données
if ($pdo = new PDO('mysql:host='.$DB_HOST, $DB_USER, $DB_PASSWORD))
{
    // création de la requête sql
    // on teste avant si elle existe ou non (par sécurité)
    $requete = "CREATE DATABASE IF NOT EXISTS `".$DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
    
    // on prépare et on exécute la requête
    $pdo->prepare($requete)->execute();

    // connexion à la bdd
    $connexion = new PDO("mysql:host=".$DB_HOST.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD);
    
    // on vérifie que la connexion est bonne
    if($connexion)
    {
        // on créer la requête (créer la table users)
        $requete = "CREATE TABLE IF NOT EXISTS users (
            user_id int(11) not null PRIMARY kEY AUTO_INCREMENT,
            user_first varchar(256) not null,
            user_last varchar(256) not null,
            user_email varchar(256) not null,
            user_uid varchar(256) not null,
            user_pwd varchar(512) not null,
            user_key varchar(256) not null,
            user_confirm int(1) not null DEFAULT '0');";
    
        // on prépare et on exécute la requête
        $connexion->prepare($requete)->execute();
    }
    
}
else
    echo "Connection failed.";
?>