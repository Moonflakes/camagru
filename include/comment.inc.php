<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (isset($_POST['comment']))
{
    if (check_user_is_connect($connexion))
    {
        header("Location: ../fr/comment.php?img=".$_POST['comment']);
        exit();
    }
    else
    {
        $_SESSION['erreur']['connect'] = "Pour commenter des photos à votre guise connectez vous !";
        header("Location: ../fr/home.php?connect=error");
        exit();
    }
}

?>