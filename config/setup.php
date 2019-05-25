<?php
include_once 'database.php';

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
        $requsertable = "CREATE TABLE IF NOT EXISTS users (
            user_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            user_first varchar(256) not null,
            user_last varchar(256) not null,
            user_email varchar(256) not null,
            user_uid varchar(256) not null,
            user_pwd varchar(512) not null,
            user_notif int(1) not null DEFAULT '1',
            user_key varchar(256) not null,
            user_confirm int(1) not null DEFAULT '0');";
    
        // on prépare et on exécute la requête
        $connexion->prepare($requsertable)->execute();

        // on créer la requête (créer la table pictures)
        $reqpictable = "CREATE TABLE IF NOT EXISTS pictures (
            picture_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            picture_author int(11) not null,
            picture_date DATETIME not null,
            picture_path LONGTEXT not null,
            picture_description varchar(256) not null);";
    
        // on prépare et on exécute la requête
        $connexion->prepare($reqpictable)->execute();

        // on créer la requête (créer la table comments)
        $reqcomtable = "CREATE TABLE IF NOT EXISTS comments (
            comment_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            comment_author int(11) not null,
            comment_date DATETIME not null,
            comment_id_pict int(11) not null,
            comment_text varchar(256) not null,
            comment_read int(1) not null DEFAULT '1');";
    
        // on prépare et on exécute la requête
        $connexion->prepare($reqcomtable)->execute();

        // on créer la requête (créer la table likes)
        $reqcomtable = "CREATE TABLE IF NOT EXISTS likes (
            like_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            like_author int(11) not null,
            like_date DATETIME not null,
            like_id_pict int(11) not null);";
    
        // on prépare et on exécute la requête
        $connexion->prepare($reqcomtable)->execute();
    }
    else
    {
        echo "Connection failed.";
        die();
    }
}
else
    echo "Connection failed.";
?>