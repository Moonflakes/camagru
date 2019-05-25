<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (isset($_POST['comment']))
{
    if (check_user_is_connect($connexion))
    {
        //header("Location: ../fr/comment.php?img=".$_POST['comment']);
        //exit();
        $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/comment.inc.php", "", $_SERVER['PHP_SELF'])."/fr/comment.php?img=".$_POST['comment'];
        $arr = array("page" => $page);

        //update comment read
        $reqcomread = 'UPDATE `comments` SET `comment_read`=? WHERE `comment_id_pict`=?';
        $connexion->prepare($reqcomread)->execute(array(0, $_POST['comment']));
    }
    else
    {
        //$_SESSION['erreur']['connect'] = "Pour commenter des photos à votre guise connectez vous !";
       // header("Location: ../fr/home.php?connect=error");
        //exit();
        $error = "Pour commenter des photos à votre guise connectez vous !";
        $arr = array("erreur" => $error);
    }
}
echo json_encode($arr);

?>