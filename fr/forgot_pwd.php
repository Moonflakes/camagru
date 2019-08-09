<?PHP
    include_once 'header.php';
    include_once 'message.php';
?>
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <section class="signup">
            <h2 class="h2sign" >Mot de passe oublié</h2>
                <table class="signup-form">
                    <tr id="uid" >
                        <td>
                            <input id="_uid" type="text" name="uid" placeholder="Pseudo"
                                value="<?php if(isset($_SESSION['u_uid'])) echo $_SESSION['u_uid']?>">
                        </td>
                    </tr>
                    <tr id="email" >
                        <td>
                            <input id="_email" type="text" name="email" placeholder="E-mail" 
                                value="<?php if(isset($_SESSION['u_email'])) echo $_SESSION['u_email']?>">
                        </td>
                    </tr>
<?php   if (isset($_SESSION['u_confirm']) && $_SESSION['u_confirm'] === 0) 
        {
?>
                    <tr>
                        <td>
                            <font color='red'>Attention votre adresse e-mail n'a pas été confirmée !</br></br>
                            Vous ne pouvez pas procéder à la réinitialisation de votre mot de passe sans avoir validé votre adresse e-mail !</br></br>
                            Veuillez vérifier votre boîte de réception ou <a href='send_confirm.php' id='fpwd-link'>cliquez ici </a>pour qu'un mail de confirmation vous soit envoyé.</font>
                        </td>
                    </tr>
<?php
        }
?>
                    <tr>
                        <td>
                            <button id="forgot" type="submit" name="submit">Envoyer</button>
                        </td>
                    </tr>
                </table>
    </section>
    <script src="../js/forgotpwd.js"></script>
<?PHP
    include_once 'footer.php';
?>