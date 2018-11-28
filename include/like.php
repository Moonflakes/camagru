<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['like']))
    {
        //like exist ?
        $reqlikexist = "SELECT * FROM `likes` WHERE `like_author`=? AND `like_id_pict`=?";
        $req = $connexion->prepare($reqlikexist);
        $req->execute(array($_SESSION['u_id'], $_POST['like']));
        $likexist = $req->rowCount();
        if ($likexist === 1)
        {
            //delete like
            $reqdellik = 'DELETE FROM `likes` WHERE `like_author`= ? AND `like_id_pict`= ?';
            $connexion->prepare($reqdellik)->execute(array($_SESSION['u_id'], $_POST['like']));
            $type = "unlike";
        }
        else
        {
            // insert like
            $reqinslik = 'INSERT INTO `likes`(`like_id`, `like_author`, `like_date`, `like_id_pict`) 
                            VALUES (?, ?, NOW(), ?)';
            $connexion->prepare($reqinslik)->execute(array(0, $_SESSION['u_id'], $_POST['like']));
            $type = "like";
        }

        //nb likes
        $reqnblik = "SELECT * FROM `likes` WHERE `like_id_pict`=?";
        $req = $connexion->prepare($reqnblik);
        $req->execute(array($_POST['like']));
        $nblik = $req->rowCount();
        $arr = array("nb_likes" => $nblik, "type" => $type, "id" => $_POST['like']);
    }
    else
    {
        echo "error";
    }
    echo json_encode($arr);
}
/*else
{
    $_SESSION['erreur']['connect'] = "Pour liker des photos à votre guise connectez vous !";
    header("Location: ../fr/home.php?connect=error");
    exit();
}*/

?>