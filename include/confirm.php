<?php
include_once '../config/setup.php';
session_start();
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
        if($user['user_confirm'] == 0)
        {
            $updateuser = $connexion->prepare("UPDATE users SET user_confirm = 1 WHERE user_uid = ? AND user_key = ?");
            $updateuser->execute(array($uid, $key));
            $_SESSION['u_confirm'] = 1;
            echo "Votre compte a bien été confirmé !";
            if (isset($_GET['resend']))
                echo  '</br><a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/confirm.php", "", $_SERVER['PHP_SELF']).'/fr/forgot_pwd.php?">Réinitialiser mon mot de passe</a>';
            else
                echo '</br><a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/confirm.php", "", $_SERVER['PHP_SELF']).'/fr/home.php">Me connecter</a>';
        }
        else
        {
            echo "Votre compte a déjà été confirmé !";
            echo '</br><a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/confirm.php", "", $_SERVER['PHP_SELF']).'/fr/home.php">Me connecter</a>';
        }
    }
    else
    {
        echo "L'utilisateur n'existe pas !";
    }
}
?>