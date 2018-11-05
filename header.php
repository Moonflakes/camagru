<?PHP
    session_start();
?>

<div class="header">
            <div class="lien_logo">
                <a href="index.php" title="Accueil">
                    <img class="logo" src="img_site/logo.png" alt="home" title="Home">
                </a>
            </div>
            <div>
                <div class="icones">
                        <a class="photo" href="webcam.php">
                            <img src="img_site/icones/camera_1.png" alt="photo" title="Photo">
                            <h4>Prendre une photo</h4>
                        </a>
                        <a class="home" href="home.php">
                            <img src="img_site/icones/home_1.png" alt="home" title="Home">
                            <h4>Home</h4>
                        </a>
                        <a class="settings" href="settings.php">
                            <img src="img_site/icones/settings_green.png" alt="settings" title="Paramètres">
                            <h4>Paramètres</h4>
                        </a>
<?php
    if (isset($_SESSION['u_id']))
    {
?>
                        <a class="logout" href="logout.php">
                            <img src="img_site/icones/logout_3.png" alt="logout" title="Logout">
                            <h4>Login</h4>
                        </a>
                        <a class="sign" href="account.php">
                            <img src="img_site/icones/account_green.png" alt="account" title="Mon compte">
                            <h4>Sign Up</h4>
                        </a>
<?php
    }
    else
    {
?>
                        <a class="login" href="home.php?login=ask">
                            <img src="img_site/icones/login_1.png" alt="login" title="Login">
                            <h4>Login</h4>
                        </a>
                        <a class="sign" href="signup.php">
                            <img src="img_site/icones/signup.png" alt="signup" title="Sign up">
                            <h4>Sign Up</h4>
                        </a>
<?php
    }
?>
                </div>
            </div>
        </div>