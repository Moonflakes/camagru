<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';
if (isset($_POST['goTo']))
{
    if (check_user_is_connect($connexion))
    {
        $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/goto.inc.php", "", $_SERVER['PHP_SELF'])."/fr/".$_POST['goTo'].".php";
        $arr = array("page" => $page, "session" => $_SESSION, "goto" => $_POST['goTo']);
    }
    else
    {
        $error = "Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté";
        $arr = array("erreur" => $error);
    }
}
echo json_encode($arr);

?>