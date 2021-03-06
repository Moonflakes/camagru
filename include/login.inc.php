<?PHP
session_start();
date_default_timezone_set('Europe/Paris');
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($uid))
    {
        $error['uid'] = "Veuillez indiquer votre nom d'utilisateur !";
    }
    if (empty($pwd))
    {
        $error['pwd'] = "Veuillez indiquer votre mot de passe !";
    }
    if (isset($error))
    {
        $arr = array("error" => $error);
    }
    else
    {
        // Check if there is an user with this uid
        $requid = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
        $req = $connexion->prepare($requid);
        $req->execute(array($uid, $uid));
        $uidexist = $req->rowCount();
        if ($uidexist < 1)
            $error['uid'] = "Nom d'utilisateur/e-mail incorrect !";
        else if ($userinfo = $req->fetch())
        {
            // fetch pour mettre toutes les informations de l'utilisateur dans un tableau de données
            //De-hashing the password
            $_SESSION['u_uid'] = $userinfo['user_uid'];
            $_SESSION['u_email'] = $userinfo['user_email'];
            $_SESSION['u_confirm'] = $userinfo['user_confirm'];
            $_SESSION['u_key'] = $userinfo['user_key'];
            $hashpwdCheck = password_verify($pwd, $userinfo['user_pwd']);
            if ($hashpwdCheck == false)
                $error['pwd'] = "Mot de passe incorrect !";
        }
        if (isset($error))
        {
            $arr = array("error" => $error);
        }
        else {
            $reqconfirm = "SELECT * FROM users WHERE user_confirm > ? AND user_uid=?";
            $req = $connexion->prepare($reqconfirm);
            $req->execute(array(0, $_SESSION['u_uid']));
            $confirm = $req->rowCount();

            if (!$confirm) {
                $error['uid'] = "Vous n'avez pas confirmeé votre adresse mail, veuillez vérifier votre boître de réception.";
            }
        }

        if (isset($error))
        {
            $arr = array("error" => $error);
        }
        else
        {
            //Log in the user here
            $_SESSION['u_id'] = $userinfo['user_id'];
            $_SESSION['u_first'] = $userinfo['user_first'];
            $_SESSION['u_last'] = $userinfo['user_last'];
            $_SESSION['u_email'] = $userinfo['user_email'];
            $_SESSION['u_uid'] = $userinfo['user_uid'];
            $_SESSION['u_key'] = $userinfo['user_key'];
            $_SESSION['u_confirm'] = $userinfo['user_confirm'];
            $_SESSION['u_notif'] = $userinfo['user_notif'];
            $_SESSION['time'] = time();

            $reqpict = "SELECT picture_id FROM pictures WHERE picture_author=?";
            $req = $connexion->prepare($reqpict);
            $req->execute(array($userinfo['user_id']));
            $pictauth = $req->fetchall();

            $arrPict = array();
            if (isset($pictauth) && isset($pictauth[0])) {
                foreach ($pictauth as $key => $value) {
                    $reqcom = "SELECT * FROM comments WHERE comment_id_pict=? AND comment_author!=? AND comment_read=1";
                    $req = $connexion->prepare($reqcom);
                    $req->execute(array($value['picture_id'], $userinfo['user_id']));
                    $nbcomunread = $req->rowCount();
                    array_push($arrPict, array($value['picture_id'], $nbcomunread));
                }
            }
            
            $arr = array("success" => "Vous vous êtes connecté avec succès", "name" => strtoupper($_SESSION['u_first']), "pictAuth" => $arrPict);
        }
    }
}
else
{
    $error['erreur'] = "Une erreur s'est produite, veuillez réessayer !";
    $arr = array("error" => $error);
}
echo json_encode($arr);

?>