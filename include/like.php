<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['like']))
    {
        // insert like
        $reqinslik = 'INSERT INTO `likes`(`like_id`, `like_author`, `like_date`, `like_id_pict`) 
                        VALUES (?, ?, NOW(), ?)';
        $connexion->prepare($reqinslik)->execute(array(0, $_SESSION['u_uid'], $_POST['like']));

        //update nb like of picture
        $up_nblike = $_POST['nblike'] + 1;
        $requpdnblik = 'UPDATE `pictures` SET `picture_nb_like`=? WHERE `picture_id`=?';
        $connexion->prepare($requpdnblik)->execute(array($up_nblike, $_POST['like']));
        
        header("Location: ../view/home.php?like=success");
        exit();
    }
    else if (isset($_POST['unlike']))
    {
        //delete like
        $reqdellik = 'DELETE FROM `likes` WHERE `like_author`= ? AND `like_id_pict`= ?';
        $connexion->prepare($reqdellik)->execute(array($_SESSION['u_uid'], $_POST['unlike']));

        //update nb like of picture
        $down_nblike = $_POST['nblike'] - 1;
        $requpdnblik = 'UPDATE `pictures` SET `picture_nb_like`=? WHERE `picture_id`=?';
        $connexion->prepare($requpdnblik)->execute(array($down_nblike, $_POST['unlike']));

        header("Location: ../view/home.php?unlike=success");
        exit();
    }
    else
    {
        header("Location: ../view/home.php?like=error");
        exit();
    }
}
else
{
    $_SESSION['erreur']['connect'] = "Pour liker des photos à votre guise connectez vous !";
    header("Location: ../view/home.php?connect=error");
    exit();
}

?>