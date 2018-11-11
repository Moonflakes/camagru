<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $_SESSION['uid'] = $uid = htmlspecialchars($_POST['uid']);
    $_SESSION['pwd'] = $pwd = htmlspecialchars($_POST['pwd']);
    $key = htmlspecialchars($_POST['submit']);
    
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
        //print_r($_SESSION);
    //print_r($_POST);
    //die();
        header("Location: ../fr/reset_pwd.php?reset=error&key=".$key);
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
            header("Location: ../fr/reset_pwd.php?reset=error&key=".$key);
            exit();
        }
        else
        {
            // vérifier si la clé de sécurité est la même que celle de l'utilisateur
            $reqkey = "SELECT * FROM users WHERE user_uid=? AND user_key=? AND user_confirm=?";
            $req = $connexion->prepare($reqkey);
            $req->execute(array($uid, $key, 2));
            $keyexist = $req->rowCount();
            if ($keyexist < 1)
                $_SESSION['erreur']['key'] = "Utilisateur invalide ! </br> 
                                                Veuillez vérifier si vous avez bien reçu votre mail de réinitialisation ! </br>
                                                Si vous n'avez pas reçu votre mail de réinitialisation 
                                                <a href='forgot_pwd.php' id='fpwd-link'>cliquez ici !</a>";
            if (isset($_SESSION['erreur']))
            {
                header("Location: ../fr/reset_pwd.php?reset=error&key=".$key);
                exit();
            }
            else
            {
                // réattribuer une nouvelle clé a l'utilisateur
                $key = "";
                for($i=1 ; $i<15 ; $i++)
                    $key .= mt_rand(0,9);
                $_SESSION['u_key'] = $key;

                $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
                $requpdate = 'UPDATE users SET user_pwd=?, user_key=?, user_confirm=? WHERE user_uid=?';
                $connexion->prepare($requpdate)->execute(array($hashpwd, $key, 1, $uid));
                $_SESSION['u_confirm'] = 1;
                $_SESSION['success'] = 'Votre mot de passe a bien été réinitialiser !';
                header("Location: ../fr/reset_pwd.php?reset=success");
            exit();
            }
        }
    }
}
else
{
    header("Location: ../fr/reset_pwd.php");
    exit();
}

?>