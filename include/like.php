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
        header("Location: ../index.php?like=success");
        exit();
    }
    else if (isset($_POST['unlike']))
    {
        //delete like
        $reqdellik = 'DELETE FROM `likes` WHERE `like_author`= ? AND `like_id_pict`= ?';
        $connexion->prepare($reqdellik)->execute(array($_SESSION['u_uid'], $_POST['unlike']));
        header("Location: ../index.php?unlike=success");
        exit();
    }
    else
    {
        header("Location: ../index.php?like=error");
        exit();
    }
}
else
{
    $_SESSION['erreur']['connect'] = "Pour liker des photos à votre guise connectez vous !";
    header("Location: ../index.php?connect=error");
    exit();
}

?>