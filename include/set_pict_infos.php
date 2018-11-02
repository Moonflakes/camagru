<?php
include_once 'config/setup.php';
include_once 'check_user.php';

$reqpicture = "SELECT * FROM pictures ORDER BY picture_date DESC";
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
            if (check_user_is_connect())
            {
                $reqlike = "SELECT * FROM likes WHERE like_author=? AND like_id_pict=?";
                $req = $connexion->prepare($reqlike);
                $req->execute(array($_SESSION['uid'], $id));

                if ($likinfo = $req->fetch())
                    $like = 1;
                else
                    $like = 0;
            }
        }
        $_SESSION['pict_'.++$i] = array('p_id' => $id, 'p_auth' => $auth, 'p_date' => $date, 'p_path' => $path, 'p_descr' => $descr, 'p_nblike' => $nblike, 'p_nbcom' => $nbcom, 'p_like' => $like);
    }
}

?>