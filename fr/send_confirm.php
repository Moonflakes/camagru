<?php
session_start();
//print_r($_SESSION);
//die();
$email = $_SESSION['u_email'];
$header="MIME-Version: 1.0\r\n";
$header.='From: Camagru.com <support@camagru.com>'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$message='
<html>
    <body>
        <div align="center">
            <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/fr/send_confirm.php", "", $_SERVER['PHP_SELF']).'/include/confirm.php?uid='.urlencode($_SESSION['u_uid']).'&key='.urlencode($_SESSION['u_key']).'&resend=1">Confirmez votre compte !</a>
        </div>
    </body>
</html>
';
$mail = mail($email, "Confirmation de compte", $message, $header);
if ($mail == TRUE)
{
    $_SESSION['success'] = 'Un mail de confirmation vient de vous être envoyé ! </br> Veuillez vérifier votre boîte de réception pour confirmer votre email.';
    header("Location: forgot_pwd.php?email=success");
}
else
{
    $_SESSION['success'] = "L'envoi de l'email à échoué !";
    header("Location: forgot_pwd.php?email=echec");
}
exit();
?>