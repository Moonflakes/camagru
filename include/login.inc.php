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
            $pictauth = $req->fetch();

            $arrPict = [];
            if (isset($pictauth)) {
                foreach ($pictauth as $key => $value) {
                    if ($key === "picture_id") {
                        $reqcom = "SELECT * FROM comments WHERE comment_id_pict=? AND comment_author!=? AND comment_read=1";
                        $req = $connexion->prepare($reqcom);
                        $req->execute(array($value, $userinfo['user_id']));
                        $nbcomunread = $req->rowCount();
                        $arrPict[$value] = $nbcomunread;
                    }
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