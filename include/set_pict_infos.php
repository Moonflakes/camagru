<?php
include_once '../config/setup.php';
session_start();

$reqpicture = "SELECT * FROM pictures ORDER BY picture_date DESC";
$req = $connexion->prepare($reqpicture);
$req->execute();

if ($pictinfo = $req->fetchall())
{
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
                $like = $value;
            if ($key2 === 'picture_nb_comment')
                $com = $value;
        }
        $_SESSION[] = array('p_id' => $id, 'p_auth' => $auth, 'p_date' => $date, 'p_path' => $path, 'p_descr' => $descr, 'p_nblike' => $like, 'p_nbcom' => $com);
    }
    //print_r($_SESSION);
    //session_unset();
    //session_destroy();
    //die();
}
?>