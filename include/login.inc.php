<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once 'install.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Errors handlers
    //Check for empty fields
    if (empty($uid) || empty($pwd))
    {
        header("Location: ../index.php?login=empty");
        exit();
    }
    else
    {
        // Check if there is an user with this uid
        $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1)
        {
            header("Location: ../index.php?login=error");
            exit();
        }
        else if ($row = mysqli_fetch_assoc($result))
        {
            //De-hashing the password
            $hashpwdCheck = password_verify($pwd, $row['user_pwd']);
            if ($hashpwdCheck == false)
            {
                header("Location: ../index.php?login=error");
                exit();
            }
            else if ($hashpwdCheck == true)
            {
                //Log in the user here
                $_SESSION['u_id'] = $row['user_id'];
                $_SESSION['u_first'] = $row['user_first'];
                $_SESSION['u_last'] = $row['user_last'];
                $_SESSION['u_email'] = $row['user_email'];
                $_SESSION['u_uid'] = $row['user_uid'];
                $_SESSION['u_admin'] = $row['user_admin'];
                header("Location: ../index.php?login=success");
                exit();
            }
        }
    }
}
else
{
    header("Location: ../index.php?login=error");
    exit();
}

?>