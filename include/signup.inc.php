<?PHP
session_start();

if (isset($_POST['submit']))
{
    include_once '../config/database.php';
    $_SESSION['first'] = $first = htmlspecialchars($_POST['first']);
    $_SESSION['last'] = $last = htmlspecialchars($_POST['last']);
    $_SESSION['email'] = $email = htmlspecialchars($_POST['email']);
    $_SESSION['uid'] = $uid = htmlspecialchars($_POST['uid']);
    $_SESSION['pwd'] = $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd))
    {
        $_SESSION['erreur'] = "Veuillez remplir tous les champs!";
        header("Location: ../signup.php?error=empty"); // ? include a message
        exit();
    }
    else
    {
        //Check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
        {
            if (!preg_match("/^[a-zA-Z]*$/", $last))
            {
                $_SESSION['erreur'] = "Nom invalide !";
                header("Location: ../signup.php?error=last");
            }
            else
            {
                $_SESSION['erreur'] = "Prénom invalide !";
                header("Location: ../signup.php?error=first");
            }
            exit();
        }
        else
        {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $_SESSION['erreur'] = "e-mail invalide !";
                header("Location: ../signup.php?error=email");
                exit();
            }
            else
            {
                // Check if there is an user with this uid
                $requid = 'SELECT * FROM users WHERE user_uid=?';
                $req = $connexion->prepare($requid);
                $req->execute(array($uid));
                $uidexist = $req->rowCount();
                if ($uidexist > 0)
                {
                    $_SESSION['erreur'] = "Nom d'utilisateur déjà utilisé !";
                    header("Location: ../signup.php?error=uid");
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
                    $reqinsert = 'INSERT INTO users (
                        `user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_key`, `user_confirm`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                    $connexion->prepare($reqinsert)->execute(array(0, $first, $last, $email, $uid, $hashpwd, $key, 0));
                    $header="MIME-Version: 1.0\r\n";
                    $header.='From: Camagru.com <support@camagru.com>'."\n";
                    $header.='Content-Type:text/html; charset="uft-8"'."\n";
                    $message='
                    <html>
                        <body>
                            <div align="center">
                                <a href="http://localhost:8100/camagru_git/include/confirm.php?uid='.urlencode($uid).'&key='.$key.'">Confirmez votre compte !</a>
                            </div>
                        </body>
                    </html>
                    ';
                    $mail = mail($email, "Confirmation de compte", $message, $header);
                    $_SESSION['erreur'] = 'Votre compte a bien été créé ! </br> Veuillez vérifier votre boîte de réception.';
                    header("Location: ../signup.php?error=success");
                    exit();
                }
            }
        }
    }

}
else
{
    header("Location: ../signup.php");
    exit();
}

?>