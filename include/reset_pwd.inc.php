<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $_SESSION['uid'] = $uid = htmlspecialchars($_POST['uid']);
    $_SESSION['pwd'] = $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($uid))
    {
        $_SESSION['erreur']['uid'] = "Veuillez indiquer votre nom d'utilisateur !";
    }
    if (empty($pwd))
    {
        $_SESSION['erreur']['pwd'] = "Veuillez indiquer votre nouveau mot de passe !";
    }
    if (isset($_SESSION['erreur']))
    {
        header("Location: ../reset_pwd.php?reset=error");
        exit();
    }
    else
    {
        // Check if there is an user with this email
        $requid = "SELECT * FROM users WHERE user_uid=?";
        $req = $connexion->prepare($requid);
        $req->execute(array($uid));
        $uidexist = $req->rowCount();
        if ($uidexist < 1)
            $_SESSION['erreur']['uid'] = "Nom d'utilisateur incorrect !";
        if (isset($_SESSION['erreur']))
        {
            header("Location: ../reset_pwd.php?reset=error");
            exit();
        }
        else
        {
            $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
            $requpdate = 'UPDATE users SET user_pwd=? WHERE user_uid=?';
            $connexion->prepare($requpdate)->execute(array($hashpwd, $uid));
            $_SESSION['success'] = 'Votre mot de passe a bien été réinitialiser !';
            header("Location: ../reset_pwd.php?reset=success");
            exit();
        }
    }
}
else
{
    header("Location: ../reset_pwd.php");
    exit();
}

?>