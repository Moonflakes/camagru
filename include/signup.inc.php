<?PHP
if (isset($_POST['submit']))
{
    include_once 'install.inc.php';
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

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
                $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0)
                {
                    /*while ($row = mysqli_fetch_assoc($result))
                    {
                        echo $row['user_uid']."<br>";
                    }*/
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                }
                else
                {
                    //Check the password > hashing ou hash("whirlpool", $pwd);
                    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Inser the user into the database
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_admin) VALUES ('$first', '$last', '$email', '$uid', '$hashpwd', 0);";
                    $result = mysqli_query($conn, $sql);
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