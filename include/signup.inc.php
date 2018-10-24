<?PHP
if (isset($_POST['submit']))
{
    include_once '../config/database.php';
    $first = htmlspecialchars($_POST['first']);
    $last = htmlspecialchars($_POST['last']);
    $email = htmlspecialchars($_POST['email']);
    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd))
    {
        header("Location: ../signup.php?signup=empty"); // ? include a message
        exit();
    }
    else
    {
        //Check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
        {
            header("Location: ../signup.php?signup=invalid");
            exit();
        }
        else
        {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                header("Location: ../signup.php?signup=email");
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
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                }
                else
                {
                    //Check the password > hashing ou hash("whirlpool", $pwd);
                    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Inser the user into the database
                    $reqinsert = 'INSERT INTO users (
                        `user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_admin`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)';
                    $connexion->prepare($reqinsert)->execute(array(0, $first, $last, $email, $uid, $hashpwd, 0));
                    header("Location: ../signup.php?signup=success");
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