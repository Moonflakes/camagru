<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (isset($_POST['comment']))
{
    $comment = htmlspecialchars($_POST['comment']);
    if (check_user_is_connect($connexion))
    {
        $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/comment.inc.php", "", $_SERVER['PHP_SELF'])."/fr/comment.php?img=".$comment;
        $arr = array("page" => $page);

        //update comment read
        $reqcomread = 'UPDATE `comments` SET `comment_read`=? WHERE `comment_id_pict`=?';
        $connexion->prepare($reqcomread)->execute(array(0, $comment));
    }
    else
    {
        $error = "Pour commenter des photos à votre guise connectez vous !";
        $arr = array("erreur" => $error);
    }
}
echo json_encode($arr);

?>