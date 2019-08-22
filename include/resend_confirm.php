<?php
    session_start();
    include_once '../config/setup.php';

        $header="MIME-Version: 1.0\r\n";
        $header.='From: Camagru.com <support@camagru.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $message='
        <html>
            <body>
                <div align="center">
                    <a href="http://'.$_SERVER['HTTP_HOST'].str_replace("/include/resend_confirm.php", "", $_SERVER['PHP_SELF']).'/include/confirm.php?uid='.urlencode($_SESSION['u_uid']).'&key='.urlencode($_SESSION['u_key']).'">Confirmez votre compte !</a>
                </div>
            </body>
        </html>
        ';
        if ($mail = mail($_SESSION['u_email'], "Confirmation de compte", $message, $header))
        {
            $_SESSION['erreur']['connect'] = "Un mail de confirmation vous a été renvoyé. Veuillez vérifier dans votre boîte de réception !";
            header("Location: ../fr/home.php?connect=error");
            // $error['success'] = 'Votre compte a bien été créé ! </br> Veuillez vérifier votre boîte de réception pour confirmer votre email.';
            // $arr = array("success" => $error);
        }
        else
        {
            $_SESSION['erreur']['connect'] = "L'envoi de l'email de confirmation à échoué !";
            header("Location: ../fr/home.php?connect=error");
            // $error['email'] = "L'envoi de l'email de confirmation à échoué ! </br> Veuillez vérifier si votre adresse mail est valide et rééssayez.";
            // $arr = array("error" => $error);
        }
?>