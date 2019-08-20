<?PHP
session_start();

if (isset($_POST['update']))
{
    include_once '../config/setup.php';
    $update = htmlspecialchars($_POST['update']);
    if ($update == "email")
    {
        $new_val = htmlspecialchars($_POST['new_val']);
        $str_param = "e-mail";
        if (empty($new_val))
            $error['email'] = "Veuillez indiquer votre nouvel e-mail!";
        else if (!filter_var($new_val, FILTER_VALIDATE_EMAIL))
            $error['email'] = "E-mail invalide !";
        else if ($new_val == $_SESSION['u_email'])
            $error['email'] = "Cet e-mail vous est déjà attribué !";
    }
    if ($update == "uid")
    {
        $new_val = htmlspecialchars($_POST['new_val']);
        $str_param = "nom d'utilisateur";
        if (empty($new_val))
            $error['uid'] = "Veuillez indiquer votre nouveau nom d'utilisateur!";
        else
        {
            // Check if there is an user with this uid
            $requid = 'SELECT * FROM users WHERE user_uid=?';
            $req = $connexion->prepare($requid);
            $req->execute(array($new_val));
            $uidexist = $req->rowCount();
            if ($uidexist > 0)
                $error['uid'] = "Ce nom d'utilisateur vous est déjà attribué !";
            if(!preg_match("/^[-a-zA-Z0-9_.]*$/", $new_val))
                $error['uid'] = "Votre nom d'utilisateur ne peut comporter que des caractères alphanumériques, -, _ ou .";
        }
    }
    if ($update == "pwd")
    {
        $str_param = "mot de passe";
        $oldpwd = htmlspecialchars($_POST['oldpwd']);
        $newpwd = htmlspecialchars($_POST["newpwd"]);
        if (empty($oldpwd))
            $error['oldpwd'] = "Veuillez indiquer votre ancien mot de passe!";
        if (empty($newpwd))
            $error['pwd'] = "Veuillez indiquer votre nouveau mot de passe!";
    }
    if (isset($error))
    {
        $arr = array("error" => $error);
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
            $error['uid'] = "Nom d'utilisateur incorrect !";
        if (isset($error))
            $arr = array("error" => $error);
        else
        {
            if ($update == "pwd")
            {
                if ($userinfo = $req->fetch())
                {
                    $hashpwdCheck = password_verify($oldpwd, $userinfo['user_pwd']);
                    if (!(password_verify($oldpwd, $userinfo['user_pwd'])))
                        $error['oldpwd'] = "Ancien mot de passe incorrect !";
                }
                if (isset($error))
                {
                    $arr = array("error" => $error);
                }
                else {
                    $len = strlen($newpwd);
                    if ($len < 8) {
                        $error['pwd'] = "Votre mot de passe doit au minimum comporter 8 caractères.";
                        $arr = array("error" => $error);
                    }
                    else
                        $new_val = password_hash($newpwd, PASSWORD_DEFAULT);
                }
            }
            if (isset($new_val)) {
                $requpdate = "UPDATE users SET user_$update=? WHERE user_uid=?";
                $connexion->prepare($requpdate)->execute(array($new_val, $uid));
                $success[$update] = 'Votre '.$str_param.' a bien été modifié !';
                if ($update != "pwd")
                    $_SESSION["u_".$update] = $new_val;
                $arr = array("success" => $success);
            }
        }
    }
}
else
{
    $error[$update] = "Une erreur s'est produite, veuillez réessayer !";
    $arr = array("error" => $error);
}
echo json_encode($arr);
?>