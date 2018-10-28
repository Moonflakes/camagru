<?PHP
session_start();

if (isset($_POST['reset']))
{
    header("Location: ../account.php?modif=".$_POST['reset']);
    exit();
}
if (isset($_POST['update']))
{
    include_once '../config/setup.php';
    $update = $_POST['update'];
    $_SESSION['param'] = $param = htmlspecialchars($_POST[$update]);

    if (empty($param) && $update == "email")
        $_SESSION['erreur']['email'] = "Veuillez indiquer votre nouvel e-mail!";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $_SESSION['erreur']['email'] = "E-mail invalide !";

    if ($update == "uid")
    {
        if (empty($param))
            $_SESSION['erreur']['uid'] = "Veuillez indiquer votre nouveau nom d'utilisateur!";
        else
        {
            // Check if there is an user with this uid
            $requid = 'SELECT * FROM users WHERE user_uid=?';
            $req = $connexion->prepare($requid);
            $req->execute(array($uid));
            $uidexist = $req->rowCount();
            if ($uidexist > 0)
                $_SESSION['erreur']['uid'] = "Nom d'utilisateur déjà utilisé !";
        }
    }
    if ($update == "pwd")
    {
        $_SESSION['oldpwd'] = $oldpwd = $param;
        $_SESSION['newpwd'] = $newpwd = htmlspecialchars($_POST["newpwd"]);
        if (empty($oldpwd))
            $_SESSION['erreur']['oldpwd'] = "Veuillez indiquer votre ancien mot de passe!";
        if (empty($newpwd))
            $_SESSION['erreur']['newpwd'] = "Veuillez indiquer votre nouveau mot de passe!";
    }
    if (isset($_SESSION['erreur']))
    {
        header("Location: ../account.php?modif=".$update."&error=".$update);
        exit();
    }
    else
    {
        echo "ba";
    }
}
else
{
    header("Location: ../reset_pwd.php");
    exit();
}

?>