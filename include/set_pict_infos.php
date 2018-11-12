<?php
include_once '../config/setup.php';
include_once 'check_user.php';

// compter le nb de photos dans la base de donnée
$reqcount = "SELECT * FROM `pictures`";
$req = $connexion->prepare($reqcount);
$req->execute();
$nb_pictures = $req->rowCount();

if (isset($_POST['nb_items']))
{
    $nb_img_pg = $_POST['nb_items'];
    $num_pg = 0;
}
else
{
    $nb_img_pg = 10;
    $num_pg = 0;
}

//selectionner x images par pages (de base le nb d'image par page est a 10)
// faire une fonction qui prend $nb_img_pg et $num_pg
//$nb_img_pg = 10;
//$num_pg = 0;
$nb_pg = ceil($nb_pictures / $nb_img_pg);

$reqpicture = "SELECT * FROM pictures ORDER BY picture_date DESC LIMIT $num_pg, $nb_img_pg";
$req = $connexion->prepare($reqpicture);
$req->execute();

if ($pictinfo = $req->fetchall())
{
    $i = 0;
    foreach ($pictinfo as $key => $array) 
    {
        foreach ($array as $key2 => $value) 
        {
            if ($key2 === 'picture_id')
               $id = $value;
            if ($key2 === 'picture_author')
                $auth = $value;
            if ($key2 === 'picture_date')
                $date = $value;
            if ($key2 === 'picture_path')
                $path = $value;
            if ($key2 === 'picture_description')
                $descr = $value;
            if ($key2 === 'picture_nb_like')
                $nblike = $value;
            if ($key2 === 'picture_nb_comment')
                $nbcom = $value;
            if (check_user_is_connect($connexion))
            {
                $reqlike = "SELECT * FROM likes WHERE like_author=? AND like_id_pict=?";
                $req = $connexion->prepare($reqlike);
                $req->execute(array($_SESSION['uid'], $id));

                if ($likinfo = $req->fetch())
                    $like = 1;
                else
                    $like = 0;
            }
            else
                $like = 0;
        }
        //print("je passe la");
        //die();
        $_SESSION['pict_'.++$i] = array('p_id' => $id, 'p_auth' => $auth, 'p_date' => $date, 'p_path' => $path, 'p_descr' => $descr, 'p_nblike' => $nblike, 'p_nbcom' => $nbcom, 'p_like' => $like);
    }
}
if (isset($_POST['nb_items']))
{
    header("Location: ../fr/home.php");
    exit();
}

?>