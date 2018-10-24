<?php
include_once '../config/database.php';

if(isset($_GET['uid'], $_GET['key']) AND !empty($_GET['uid']) AND !empty($_GET['key'])) 
{
    $uid = htmlspecialchars(urldecode($_GET['uid']));
    $key = htmlspecialchars($_GET['key']);
    $requser = $connexion->prepare("SELECT * FROM users WHERE user_uid = ? AND user_key = ?");
    $requser->execute(array($uid, $key));
    $userexist = $requser->rowCount();
    if($userexist == 1)
    {
        $user = $requser->fetch();
        if($user['confirme'] == 0)
        {
            $updateuser = $connexion->prepare("UPDATE users SET confirm = 1 WHERE user_uid = ? AND user_key = ?");
            $updateuser->execute(array($uid, $key));
            echo "Votre compte a bien été confirmé !";
        }
        else
        {
            echo "Votre compte a déjà été confirmé !";
        }
    }
    else
    {
        echo "L'utilisateur n'existe pas !";
    }
}
?>