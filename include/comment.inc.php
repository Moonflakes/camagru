<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (isset($_POST['comment']))
{
    $comment = htmlspecialchars($_POST['comment']);
    $key = isset($_POST['key']) ? htmlspecialchars($_POST['key']) : null;
    $keyid = $key ? 1 : 0;
    if (check_user_is_connect($connexion))
    {
        $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/comment.inc.php", "", $_SERVER['PHP_SELF'])."/fr/comment.php?img=".$comment;
        $arr = array("page" => $page);

        if ($key) {
            $reqkeyid = "SELECT `user_key` FROM `users` WHERE `user_uid` = ?";
            $requ = $connexion->prepare($reqkeyid);
            $requ->execute(array($_SESSION['u_uid']));
            $keyid = $requ->rowCount();
        }

        //update comment read
        if ($keyid) {
            $reqcomread = 'UPDATE `comments` SET `comment_read`=? WHERE `comment_id_pict`=?';
            $connexion->prepare($reqcomread)->execute(array(0, $comment));
        }
    }
    else
    {
        $error = "Pour commenter des photos à votre guise connectez vous !";
        $arr = array("erreur" => $error);
    }
}
echo json_encode($arr);

?>