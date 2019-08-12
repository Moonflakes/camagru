<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['like']))
    {
        $id = htmlspecialchars($_SESSION['u_id']);
        $like = htmlspecialchars($_POST['like']);

        //like exist ?
        $reqlikexist = "SELECT * FROM `likes` WHERE `like_author`=? AND `like_id_pict`=?";
        $req = $connexion->prepare($reqlikexist);
        $req->execute(array($id, $like));
        $likexist = $req->rowCount();
        if ($likexist === 1)
        {
            //delete like
            $reqdellik = 'DELETE FROM `likes` WHERE `like_author`= ? AND `like_id_pict`= ?';
            $connexion->prepare($reqdellik)->execute(array($id, $like));
            $type = "unlike";
        }
        else
        {
            // insert like
            $reqinslik = 'INSERT INTO `likes`(`like_id`, `like_author`, `like_date`, `like_id_pict`) 
                            VALUES (?, ?, NOW(), ?)';
            $connexion->prepare($reqinslik)->execute(array(0, $id, $like));
            $type = "like";
        }

        //nb likes
        $reqnblik = "SELECT * FROM `likes` WHERE `like_id_pict`=?";
        $req = $connexion->prepare($reqnblik);
        $req->execute(array($like));
        $nblik = $req->rowCount();
        $arr = array("nb_likes" => $nblik, "type" => $type, "id" => $like);
    }
    else
    {
        echo "error";
    }
    
}
else
{
    //$_SESSION['erreur']['connect'] = "Pour liker des photos à votre guise connectez vous !";
    //header("Location: ../fr/home.php?connect=error");
    //exit();
    $error = "Pour liker des photos à votre guise connectez vous !";
    $arr = array("erreur" => $error);
}
echo json_encode($arr);

?>