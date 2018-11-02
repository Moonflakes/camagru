<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect())
{
    if (isset($_POST['like']))
    {

    }
    else
    {
        header("Location: ../index.php");
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