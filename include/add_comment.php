<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['envoyer']))
    {
        $id_pict = $_POST['envoyer'];
        if (!empty($_POST['comment']))
        {
            $text_com = $_POST['comment'];
            // insert comment
            $reqinscom = 'INSERT INTO `comments`(`comment_id`, `comment_author`, `comment_date`, `comment_id_pict`, `comment_text`) 
                            VALUES (?, ?, NOW(), ?, ?)';
            $connexion->prepare($reqinscom)->execute(array(0, $_SESSION['u_id'], $id_pict, $text_com));
            
            header("Location: ../fr/comment.php?img=".$id_pict."&comment=success");
            exit();
        }
        else
        {
            $_SESSION['erreur']['comment'] = "Vous n'avez pas écrit de commentaire !";
            header("Location: ../fr/comment.php?img=".$id_pict."&comment=error");
            exit();
        }
    }
   /* else if (isset($_POST['uncomment']))
    {
        //delete comment
        $reqdelcom = 'DELETE FROM `comments` WHERE `comment_author`= ? AND `comment_id_pict`= ?';
        $connexion->prepare($reqdelcom)->execute(array($_SESSION['u_uid'], $_POST['uncomment']));

        //update nb comment of picture
        $down_nbcomment = $_POST['nbcomment'] - 1;
        $requpdnbcom = 'UPDATE `pictures` SET `picture_nb_comment`=? WHERE `picture_id`=?';
        $connexion->prepare($requpdnbcom)->execute(array($down_nbcomment, $_POST['uncomment']));

        header("Location: ../fr/home.php?uncomment=success");
        exit();
    }*/
    else
    {
        header("Location: ../fr/home.php?img=".$id_pict."&comment=error");
        exit();
    }
}
else
{
    $_SESSION['erreur']['connect'] = "Pour commentr des photos à votre guise connectez vous !";
    header("Location: ../fr/home.php?connect=error");
    exit();
}

?>