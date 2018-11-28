<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';
include_once 'formatime.php';
date_default_timezone_set('Europe/Paris');

if (check_user_is_connect($connexion))
{
    if (isset($_POST['id_pict'])) //id_pict
    {
        $id_pict = $_POST['id_pict'];
        if (!empty($_POST['text'])) //text
        {
            $text_com = $_POST['text'];
            // insert comment
            $reqinscom = 'INSERT INTO `comments`(`comment_id`, `comment_author`, `comment_date`, `comment_id_pict`, `comment_text`) 
                            VALUES (?, ?, NOW(), ?, ?)';
            $connexion->prepare($reqinscom)->execute(array(0, $_SESSION['u_id'], $id_pict, $text_com));
            
            $reqtime = "SELECT `comment_date`, `comment_id` FROM `comments` WHERE `comment_id_pict`=22 ORDER BY comment_date DESC";
            $req = $connexion->prepare($reqtime);
            $req->execute(array($id_pict));
            $arr_time = $req->fetchall();

            foreach ($arr_time as $key => $value) {
                $date = new DateTime($value['comment_date']);
                $now = new DateTime("now");
                $dif_time = date_diff($now, $date);
                $time[$value['comment_id']] = formatime($dif_time);
                if ($key === 0)
                {
                    $id_com = $value['comment_id'];
                }
                if ($key === 1)
                {
                    $id_next = $value['comment_id'];
                }
            }

            $arr = array("author" => $_SESSION['u_uid'], "text" => $text_com, "time" => $time, "id" => $id_com, "id_next" => $id_next);
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
    echo json_encode($arr);
}
else
{
    $_SESSION['erreur']['connect'] = "Pour commentr des photos à votre guise connectez vous !";
    header("Location: ../fr/home.php?connect=error");
    exit();
}

?>