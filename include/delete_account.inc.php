<?PHP
session_start();

if (isset($_POST['first']))
{
    include_once '../config/setup.php';
    $first = htmlspecialchars($_POST['first']);
    $last = htmlspecialchars($_POST['last']);
    $email = htmlspecialchars($_POST['email']);
    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $id = $_SESSION['u_id'];
    $page = null;

    //Errors handlers
    //Check for email
    if (empty($email))
        $error['email'] = "Veuillez indiquer votre email!";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error['email'] = "E-mail invalide !";

    //Check for user name
    if (empty($uid))
        $error['uid'] = "Veuillez indiquer votre nom d'utilisateur!";

    //Check for first password
    if (empty($pwd))
        $error['pwd'] = "Veuillez indiquer votre mot de passe!";

    if (isset($error))
        $arr = array("error" => $error);
    else {
        $requser = "SELECT * FROM users WHERE `user_first` = ? AND `user_last` = ? AND `user_email` = ? AND `user_uid` = ?";
        $req = $connexion->prepare($requser);
        $req->execute(array($first, $last, $email, $uid));
        $userexist = $req->rowCount();
        $userinfo = $req->fetch();

        if ($userexist > 0) {
            $hashpwdCheck = password_verify($pwd, $userinfo['user_pwd']);
            if (!(password_verify($pwd, $userinfo['user_pwd'])))
                $error['pwd'] = "Mot de passe incorrect !";
            else {
                // DELETE ALL
                $reqdeluserlikes = 'DELETE FROM `likes` WHERE `like_author`= ?';
                $connexion->prepare($reqdeluserlikes)->execute(array($id));

                $reqdelusercomments = 'DELETE FROM `comments` WHERE `comment_author`= ?';
                $connexion->prepare($reqdelusercomments)->execute(array($id));

                $reqdeluserpictures = 'DELETE FROM `pictures` WHERE `picture_author`= ?';
                $connexion->prepare($reqdeluserpictures)->execute(array($id));

                $reqdeluser = 'DELETE FROM `users` WHERE `user_id`= ?';
                $connexion->prepare($reqdeluser)->execute(array($id));

                $error['success'] = 'Votre compte a bien été supprimé.';
                $page = "http://".$_SERVER['HTTP_HOST'].str_replace("/include/delete_account.inc.php", "", $_SERVER['PHP_SELF'])."/include/logout.inc.php?delete=ok";
            }
        }
        else {
            $reqemail = "SELECT * FROM users WHERE `user_id` = ? AND `user_email` = ?";
            $req = $connexion->prepare($reqemail);
            $req->execute(array($id, $email));
            $goodemail = $req->rowCount();

            $requid = "SELECT * FROM users WHERE `user_id` = ? AND `user_uid` = ?";
            $req = $connexion->prepare($requid);
            $req->execute(array($id, $uid));
            $gooduid = $req->rowCount();

            if (!$goodemail)
                $error['email'] = "Votre email est incorrect!";
            if (!$gooduid)
                $error['uid'] = "Votre nom d'utilisateur est incorrect!";
        }
        if (isset($error)) {
            if (isset($error['success']))
                $arr = array("success" => $error['success'], "page" => $page);
            else
                $arr = array("error" => $error);
        }
    }
}
else {
    $error['post'] = "Une erreur s'est produite, veuillez réessayer !";
    $arr = array("error" => $error);
}
echo json_encode($arr);

?>
