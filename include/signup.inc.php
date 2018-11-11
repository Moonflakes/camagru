<?PHP
session_start();

if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $_SESSION['first'] = $first = htmlspecialchars($_POST['first']);
    $_SESSION['last'] = $last = htmlspecialchars($_POST['last']);
    $_SESSION['email'] = $email = htmlspecialchars($_POST['email']);
    $_SESSION['uid'] = $uid = htmlspecialchars($_POST['uid']);
    $_SESSION['pwd'] = $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for first
    if (empty($first))
        $_SESSION['erreur']['first'] = "Veuillez indiquer votre prénom!";
    else if (!preg_match("/^[a-zA-Z]*$/", $first))
        $_SESSION['erreur']['first'] = "Prénom invalide !";

    //Check for last
    if (empty($last))
        $_SESSION['erreur']['last'] = "Veuillez indiquer votre nom!";
    else if (!preg_match("/^[a-zA-Z]*$/", $last))
        $_SESSION['erreur']['last'] = "Nom invalide !";

    //Check for email
    if (empty($email))
        $_SESSION['erreur']['email'] = "Veuillez indiquer votre email!";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $_SESSION['erreur']['email'] = "E-mail invalide !";

    //Check for user name
    if (empty($uid))
        $_SESSION['erreur']['uid'] = "Veuillez indiquer votre nom d'utilisateur!";
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

    //Check for first password
    if (empty($pwd))
        $_SESSION['erreur']['pwd'] = "Veuillez indiquer votre mot de passe!";

    if (isset($_SESSION['erreur']))
    {
        header("Location: ../fr/signup.php?signup=error");
        exit();
    }
    else
    {
        // create key
        $key = "";
        for($i=1 ; $i<15 ; $i++)
        $key .= mt_rand(0,9);
        //Check the password > hashing ou hash("whirlpool", $pwd);
        $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
        //Inser the user into the database
        $reqinsert = 'INSERT INTO users (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_key`, `user_confirm`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $connexion->prepare($reqinsert)->execute(array(0, $first, $last, $email, $uid, $hashpwd, $key, 0));
        $header="MIME-Version: 1.0\r\n";
        $header.='From: Camagru.com <support@camagru.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $message='
        <html>
            <body>
                <div align="center">
                    <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/signup.inc.php", "", $_SERVER['PHP_SELF']).'/include/confirm.php?uid='.urlencode($uid).'&key='.$key.'">Confirmez votre compte !</a>
                </div>
            </body>
        </html>
        ';
        if ($mail = mail($email, "Confirmation de compte", $message, $header))
        {
            $_SESSION['success'] = 'Votre compte a bien été créé ! </br> Veuillez vérifier votre boîte de réception pour confirmer votre email.';
            header("Location: ../fr/signup.php?signup=success");
        }
        else
        {
            $_SESSION['success'] = "L'envoi de l'email à échoué !";
            header("Location: ../fr/signup.php?signup=email_echec");
        }
        exit();
    }
}
else
{
    header("Location: ../fr/signup.php");
    exit();
}

?>
