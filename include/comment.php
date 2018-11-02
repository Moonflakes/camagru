<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect())
{

}
else
{
    $_SESSION['erreur']['connect'] = "Pour commenter des photos à votre guise connectez vous !";
    header("Location: index.php?connect=error");
    exit();
}

?>