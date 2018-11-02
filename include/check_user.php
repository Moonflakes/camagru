<?php
session_start();

//si $GET pas pris remplacer par une variable array et envoyer $GET dans la fonction
function check_user_is_connect()
{
    if (isset($_GET))
    {
        include_once '../config/setup.php';
        if (isset($_GET['uid']) && isset($_GET['key']))
        {
            // Check if there is an user with this email
            $requser = "SELECT * FROM users WHERE user_uid=? AND user_key=?";
            $req = $connexion->prepare($requser);
            $req->execute(array($_GET['uid'], $_GET['key']));
            $connectexist = $req->rowCount();
            if ($connectexist < 1 || !isset($_SESSION['u_id']))
            {
                return (0);
                // et faire header index.php?connect=error
            }
            else
                return (1);
        }
        else
            return (0);
    }
    else
        return (0);
}
?>