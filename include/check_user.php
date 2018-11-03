<?php

//si $GET pas pris remplacer par une variable array et envoyer $GET dans la fonction
function check_user_is_connect($connexion)
{
    if (isset($_SESSION))
    {
        
        if (isset($_SESSION['u_uid']) && isset($_SESSION['u_key']))
        {
            // Check if there is an user with this email
            $requser = "SELECT * FROM users WHERE user_uid=? AND user_key=?";
            $req = $connexion->prepare($requser);
            $req->execute(array($_SESSION['u_uid'], $_SESSION['u_key']));
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