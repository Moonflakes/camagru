<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/webcam.inc.php", "", $_SERVER['PHP_SELF'])."/fr/webcam.php";
    $arr = array("page" => $page);
}
else
{
    $error = "Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté";
    $arr = array("erreur" => $error);
}
echo json_encode($arr);

?>