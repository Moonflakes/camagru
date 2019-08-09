<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';
include_once 'formatime.php';
date_default_timezone_set('Europe/Paris');

if (check_user_is_connect($connexion))
{
    if (isset($_POST['id_pict'])) //id-pict
    {
        $id_pict = $_POST['id_pict'];
        if (!empty($_POST['text'])) //text
        {
            $text_com = htmlspecialchars($_POST['text']);
            // insert comment
            $reqinscom = 'INSERT INTO `comments`(`comment_id`, `comment_author`, `comment_date`, `comment_id_pict`, `comment_text`, `comment_read`) 
                            VALUES (?, ?, NOW(), ?, ?, ?)';
            $connexion->prepare($reqinscom)->execute(array(0, $_SESSION['u_id'], $id_pict, $text_com, 1));
            
            $reqtime = "SELECT `comment_date`, `comment_id` FROM `comments` WHERE `comment_id_pict`=? ORDER BY comment_date DESC";
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
            }

            $arr = array("author" => $_SESSION['u_uid'], "text" => $text_com, "time" => $time, "id" => $id_com);

            $reqauthpict = "SELECT `picture_author` FROM `pictures` WHERE `picture_id` = ?";
            $requ = $connexion->prepare($reqauthpict);
            $requ->execute(array($id_pict));
            $author = $requ->fetch();

            $reqnotifexist = "SELECT `user_notif`, `user_email` FROM `users` WHERE `user_id` = ?";
            $reque = $connexion->prepare($reqnotifexist);
            $reque->execute(array($author['picture_author']));
            $notif = $reque->fetch();
            // echo '<pre>'; 
            // print($notif['user_notif']); 
            // print($author['picture_author']);
            // print($_SESSION['u_id']); 
            // echo '</pre>';

            if (isset($notif['user_notif']) && $notif['user_notif'] == 1 && $author['picture_author'] != $_SESSION['u_id']) {
                $header="MIME-Version: 1.0\r\n";
                $header.='From: Camagru.com <support@camagru.com>'."\n";
                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                $message='
                <html>
                    <body>
                        <div align="center">
                            <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/add_comment.php", "", $_SERVER['PHP_SELF']).'/fr/comment.php?img='.$id_pict.'">Une de vos photos a été commentée</a>
                        </div>
                    </body>
                </html>
                ';
                if (isset($notif['user_email'])) {
                    if ($mail = mail($notif['user_email'], "Nouveau commentaire", $message, $header))
                    {
                        $arr = array("author" => $_SESSION['u_uid'], "text" => $text_com, "time" => $time, "id" => $id_com, "mail" => "ok");
                    }
                    else
                    {
                        $arr = array("erreur" => "Notification non envoyée");
                    }
                }
            }
        }
        else
        {
            $error = "Vous n'avez pas écrit de commentaire !";
            $arr = array("erreur" => $error);
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
        $error = "Aucune image";
        $arr = array("erreur" => $error);
    }
    echo json_encode($arr);
}
else
{
    $_SESSION['erreur']['connect'] = "Pour commenter des photos à votre guise connectez vous !";
    header("Location: ../fr/home.php?login=ask");
    exit();
}

?>