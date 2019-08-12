<?PHP
session_start();
if (isset($_POST['submit']))
{
    include_once '../config/setup.php';
    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $key = htmlspecialchars($_POST['submit']);
    
    //Errors handlers
    //Check for empty fields
    if (empty($uid))
    {
        $error['uid'] = "Veuillez indiquer votre nom d'utilisateur !";
    }
    else {
        // Check if there is an user with this email
        $requid = "SELECT * FROM users WHERE user_uid=?";
        $req = $connexion->prepare($requid);
        $req->execute(array($uid));
        $uidexist = $req->rowCount();
        if ($uidexist < 1)
            $error['uid'] = "Nom d'utilisateur incorrect !";
    }
    if (empty($pwd))
    {
        $error['pwd'] = "Veuillez indiquer votre nouveau mot de passe !";
    }
    else {
        $len = strlen($pwd);
        if ($len < 8)
            $error['pwd'] = "Votre mot de passe doit au minimum comporter 8 caractères.";
    }
    if (isset($error))
    {
        $arr = array("error" => $error);
    }
    else
    {
        // vérifier si la clé de sécurité est la même que celle de l'utilisateur
        $reqkey = "SELECT * FROM users WHERE user_uid=? AND user_key=? AND user_confirm=?";
        $req = $connexion->prepare($reqkey);
        $req->execute(array($uid, $key, 2));
        $keyexist = $req->rowCount();
        
        if ($keyexist < 1)
            $erKey = "Utilisateur invalide ! </br> 
                                            Veuillez vérifier si vous avez bien reçu votre mail de réinitialisation ! </br>
                                            Si vous n'avez pas reçu votre mail de réinitialisation 
                                            <a href='forgot_pwd.php' id='fpwd-link'>cliquez ici !</a>";
        if (isset($erKey))
        {
            $arr = array("key" => $erKey);
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
            $_SESSION['pwd'] = $pwd;

            $arr = array("success" => 'Votre mot de passe a bien été réinitialiser ! </br><a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/reset_pwd.inc.php", "", $_SERVER['PHP_SELF']).'/fr/home.php?login=ask">Me connecter</a>');
        }
    }
}
else
{
    $error['post'] = "Une erreur s'est produite, veuillez rééssayer en cliquant sur le lien de réinitialisation de votre mail !";
    $arr = array("error" => $error);
}
echo json_encode($arr);

?>