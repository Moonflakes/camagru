<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $email = htmlspecialchars($_POST['email']);
    $uid = (isset($_SESSION['u_uid'])) ? $_SESSION['u_uid'] : $_POST['uid'];

    //Errors handlers
    //Check for empty fields
    if (empty($email))
    {
        //header("Location: ../fr/forgot_pwd.php?forgot=empty");
        $error['email'] = "Veuillez indiquer votre e-mail !";
        //exit();
    }
    if (empty($uid))
    {
        $error['uid'] = "Veuillez indiquer votre Nom d'utilisateur";
    }
    if ($error) {
        $arr = array("erreur" => $error);
    }
    else
    {
        // Check if there is an user with this email
        $requemail = "SELECT * FROM users WHERE user_email=? AND user_uid=?";
        $req = $connexion->prepare($requemail);
        $req->execute(array($email, $uid));
        $emailexist = $req->rowCount();
        if ($emailexist < 1)
            $error = "E-mail incorrect !";
        if (isset($error))
        {
            $arr = array("erreur" => $error);
            //header("Location: ../fr/forgot_pwd.php?forgot=error");
            //exit();
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
                        <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/forgot_pwd.inc.php", "", $_SERVER['PHP_SELF']).'/fr/reset_pwd.php?uid='.urlencode($userinfo['user_uid']).'&key='.$key.'">Réinitialisez votre mot de passe !</a>
                    </div>
                </body>
            </html>
            ';
            $mail = mail($email, "Réinitialisation de votre mot de passe", $message, $header);
            if ($mail == TRUE)
            {
                $success = 'Un e-mail de réinisalisation vient de vous être envoyé ! </br> Veuillez vérifier votre boîte de réception.';
                $arr = array("success" => $success);
                //header("Location: ../fr/forgot_pwd.php?forgot=success");
            }
            else
            {
                $success = "L'envoie de l'email à échoué !";
                $arr = array("success" => $success);
                //header("Location: ../fr/forgot_pwd.php?forgot=email_echec");
            }
            exit();
        }
    }
}
else
{
    $error = "Une erreur s'est produite, veuillez réessayer !";
    $arr = array("erreur" => $error);
    //header("Location: ../fr/forgot_pwd.php");
    //exit();
}
echo json_encode($arr);

?>