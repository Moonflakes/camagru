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
        header("Location: ../forgot_pwd.php?forgot=empty");
        $_SESSION['erreur']['email'] = "Veuillez indiquer votre e-mail !";
        exit();
    }
    else
    {
        // Check if there is an user with this email
        $requemail = "SELECT * FROM users WHERE user_email=?";
        $req = $connexion->prepare($requemail);
        $req->execute(array($email));
        $emailexist = $req->rowCount();
        if ($emailexist < 1)
            $_SESSION['erreur']['email'] = "E-mail incorrect !";
        if (isset($_SESSION['erreur']))
        {
            header("Location: ../forgot_pwd.php?forgot=error");
            exit();
        }
        else
        {
            $userinfo = $req->fetch();
            $header="MIME-Version: 1.0\r\n";
            $header.='From: Camagru.com <support@camagru.com>'."\n";
            $header.='Content-Type:text/html; charset="uft-8"'."\n";
            $message='
            <html>
                <body>
                    <div align="center">
                        <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/forgot_pwd.inc.php", "", $_SERVER['PHP_SELF']).'/reset_pwd.php?uid='.urlencode($userinfo['user_uid']).'">Réinitialisez votre mot de passe !</a>
                    </div>
                </body>
            </html>
            ';
            if ($mail = mail($email, "Réinitialisation de votre mot de passe", $message, $header))
            {
                print($email);
                print($message);
                print($mail);
                print($header);
                die();
                $_SESSION['success'] = 'Un e-mail de réinisalisation vient de vous être envoyé ! </br> Veuillez vérifier votre boîte de réception.';
                header("Location: ../forgot_pwd.php?forgot=success");
            }
            else
            {
                $_SESSION['success'] = "L'envoie de l'email à échoué !";
                header("Location: ../forgot_pwd.php?forgot=email_echec");
            }
            exit();
        }
    }
}
else
{
    header("Location: ../forgot_pwd.php");
    exit();
}

?>