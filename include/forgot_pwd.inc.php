<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $_SESSION['email'] = $email = htmlspecialchars($_POST['email']);

    //Errors handlers
    //Check for empty fields
    if (empty($email))
    {
        header("Location: ../view/forgot_pwd.php?forgot=empty");
        $_SESSION['erreur']['email'] = "Veuillez indiquer votre e-mail !";
        exit();
    }
    else
    {
        // Check if there is an user with this email
        $requemail = "SELECT * FROM users WHERE user_email=? AND user_uid=?";
        $req = $connexion->prepare($requemail);
        $req->execute(array($email, $_SESSION['u_uid']));
        $emailexist = $req->rowCount();
        if ($emailexist < 1)
            $_SESSION['erreur']['email'] = "E-mail incorrect !";
        if (isset($_SESSION['erreur']))
        {
            header("Location: ../view/forgot_pwd.php?forgot=error");
            exit();
        }
        else
        {
            $userinfo = $req->fetch();

            // initialisation d'une clé de sécurité
            $key = "";
            for($i=1 ; $i<15 ; $i++)
                $key .= mt_rand(0,9);
            $_SESSION['u_key'] = $key;
            //print($key);
            //die();
            $requpdate = 'UPDATE users SET user_key=?, user_confirm=? WHERE user_uid=?';
            $connexion->prepare($requpdate)->execute(array($key, 2, $userinfo['user_uid']));
            $_SESSION['u_confirm'] = 2;

            $header="MIME-Version: 1.0\r\n";
            $header.='From: Camagru.com <support@camagru.com>'."\n";
            $header.='Content-Type:text/html; charset="uft-8"'."\n";
            $message='
            <html>
                <body>
                    <div align="center">
                        <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/forgot_pwd.inc.php", "", $_SERVER['PHP_SELF']).'/view/reset_pwd.php?uid='.urlencode($userinfo['user_uid']).'&key='.$key.'">Réinitialisez votre mot de passe !</a>
                    </div>
                </body>
            </html>
            ';
            $mail = mail($email, "Réinitialisation de votre mot de passe", $message, $header);
            if ($mail == TRUE)
            {
                $_SESSION['success'] = 'Un e-mail de réinisalisation vient de vous être envoyé ! </br> Veuillez vérifier votre boîte de réception.';
                header("Location: ../view/forgot_pwd.php?forgot=success");
            }
            else
            {
                $_SESSION['success'] = "L'envoie de l'email à échoué !";
                header("Location: ../view/forgot_pwd.php?forgot=email_echec");
            }
            exit();
        }
    }
}
else
{
    header("Location: ../view/forgot_pwd.php");
    exit();
}

?>