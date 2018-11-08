<?PHP
session_start();

if (isset($_POST['reset']))
{
    header("Location: ../view/account.php?modif=".$_POST['reset']);
    exit();
}
if (isset($_POST['update']))
{
    include_once '../view/config/setup.php';
    $update = $_POST['update'];
    $_SESSION['param'] = $param = htmlspecialchars($_POST[$update]);
    if ($update == "email")
    {
        $str_param = "e-mail";
        if (empty($param))
            $_SESSION['erreur']['email'] = "Veuillez indiquer votre nouvel e-mail!";
        else if (!filter_var($param, FILTER_VALIDATE_EMAIL))
            $_SESSION['erreur']['email'] = "E-mail invalide !";
        else if ($param == $_SESSION['u_email'])
            $_SESSION['erreur']['email'] = "Cet e-mail vous est déjà attribué !";
    }
    if ($update == "uid")
    {
        $str_param = "nom d'utilisateur";
        if (empty($param))
            $_SESSION['erreur']['uid'] = "Veuillez indiquer votre nouveau nom d'utilisateur!";
        else
        {
            // Check if there is an user with this uid
            $requid = 'SELECT * FROM users WHERE user_uid=?';
            $req = $connexion->prepare($requid);
            $req->execute(array($param));
            $uidexist = $req->rowCount();
            if ($uidexist > 0)
                $_SESSION['erreur']['uid'] = "Ce nom d'utilisateur vous est déjà attribué !";
        }
    }
    if ($update == "pwd")
    {
        print_r($_POST);
        $str_param = "mot de passe";
        $_SESSION['oldpwd'] = $oldpwd = htmlspecialchars($_POST['oldpwd']);
        $_SESSION['newpwd'] = $newpwd = htmlspecialchars($_POST["newpwd"]);
        if (empty($oldpwd))
            $_SESSION['erreur']['oldpwd'] = "Veuillez indiquer votre ancien mot de passe!";
        if (empty($newpwd))
            $_SESSION['erreur']['newpwd'] = "Veuillez indiquer votre nouveau mot de passe!";
    }
    if (isset($_SESSION['erreur']))
    {
        header("Location: ../view/account.php?modif=".$update."&error=".$update);
        exit();
    }
    else
    {
        // Check if there is an user with this email
        $uid = htmlspecialchars($_SESSION['u_uid']);
        $requid = "SELECT * FROM users WHERE user_uid=?";
        $req = $connexion->prepare($requid);
        $req->execute(array($uid));
        $uidexist = $req->rowCount();
        if ($uidexist < 1)
            $_SESSION['erreur']['uid'] = "Nom d'utilisateur incorrect !";
        if (isset($_SESSION['erreur']))
        {
            header("Location: ../view/account.php?modif=uid");
            exit();
        }
        else
        {
            if ($update == "pwd")
            {
                if ($userinfo = $req->fetch())
                {
                    $hashpwdCheck = password_verify($oldpwd, $userinfo['user_pwd']);
                    if (!(password_verify($oldpwd, $userinfo['user_pwd'])))
                        $_SESSION['erreur']['oldpwd'] = "Ancien mot de passe incorrect !";
                }
                if (isset($_SESSION['erreur']))
                {
                    header("Location: ../view/account.php?modif=oldpwd&error=oldpwd");
                    exit();
                }
                else
                    $param = password_hash($newpwd, PASSWORD_DEFAULT);
            }
            $requpdate = "UPDATE users SET user_$update=? WHERE user_uid=?";
            $connexion->prepare($requpdate)->execute(array($param, $uid));
            $_SESSION['success'] = 'Votre '.$str_param.' a bien été modifié !';
            if ($update != "pwd")
                $_SESSION["u_".$update] = $param;
            header("Location: ../view/account.php?modif=success");
            exit();
        }
    }
}
else
{
    header("Location: ../view/account.php");
    exit();
}
?>