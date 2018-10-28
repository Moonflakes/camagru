<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $_SESSION['uid'] = $uid = htmlspecialchars($_POST['uid']);
    $_SESSION['pwd'] = $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($uid) || empty($pwd))
    {
        header("Location: ../index.php?login=empty");
        exit();
    }
    else
    {
        // Check if there is an user with this uid
        $requid = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
        $req = $connexion->prepare($requid);
        $req->execute(array($uid, $uid));
        $uidexist = $req->rowCount();
        if ($uidexist < 1)
            $_SESSION['erreur']['uid'] = "Nom d'utilisateur/e-mail incorrect !";
        else if ($userinfo = $req->fetch())
        {
            // fetch pour mettre toutes les informations de l'utilisateur dans un tableau de données
            //De-hashing the password
            $hashpwdCheck = password_verify($pwd, $userinfo['user_pwd']);
            if ($hashpwdCheck == false)
                $_SESSION['erreur']['pwd'] = "Mot de passe incorrect !";
        }
        if (isset($_SESSION['erreur']))
        {
            header("Location: ../index.php?login=error");
            exit();
        }
        else
        {
            //Log in the user here
            $_SESSION['u_id'] = $userinfo['user_id'];
            $_SESSION['u_first'] = $userinfo['user_first'];
            $_SESSION['u_last'] = $userinfo['user_last'];
            $_SESSION['u_email'] = $userinfo['user_email'];
            $_SESSION['u_uid'] = $userinfo['user_uid'];
            $_SESSION['u_admin'] = $userinfo['user_admin'];
            header("Location: ../index.php?login=success");
            exit();
        }
    }
}
else
{
    header("Location: ../index.php");
    exit();
}

?>