<?PHP
    session_start();
?>
<link rel="stylesheet" type="text/css" href="../css/header.css">
    <div class="header">
        <div class="icones-left">
            <a class="photo" href="webcam.php">
                <img src="../img_site/icones/camera_1.png" alt="photo" title="Photo">
                <h4>Prendre une photo</h4>
            </a>
            <a class="home" href="home.php">
                <img src="../img_site/icones/home_1.png" alt="home" title="Acceuil">
                <h4>Acceuil</h4>
            </a>
            <a href="settings.php">
                <img src="../img_site/icones/settings_green.png" alt="settings" title="Paramètres">
                <h4>Paramètres</h4>
            </a>
        </div>
        <div class="logo">    
            <a href="home.php">
                <img src="../img_site/logo_3.png" alt="accueil" title="Accueil">
                <h4>Acceuil</h4>
            </a>
        </div>
        <div class="icones-right">    
<?php
    if (isset($_SESSION['u_id']))
    {
?>
            <a class="logout" href="../include/logout.inc.php">
                <img src="../img_site/icones/logout_3.png" alt="logout" title="Déconnexion">
                <h4>Déconnexion</h4>
            </a>
            <a class="account" href="account.php">
                <div class="compte">
                    <img src="../img_site/icones/account_green.png" alt="account" title="Mon compte"> 
                    <div class="name">
                        <?php echo strtoupper($_SESSION['u_first']);?>
                    </div>
                </div>                          
                <h4>Mon compte</h4>
            </a>
<?php
    }
    else
    {
?>
            <a class="login" href="login2.php">
                <img src="../img_site/icones/login_1.png" alt="login" title="Connexion">
                <h4>Connexion</h4>
            </a>
            <a class="sign" href="signup.php">
                <img src="../img_site/icones/signup.png" alt="signup" title="Inscription">
                <h4>Inscription</h4>
            </a>
<?php
    }
?>
        </div>
    </div>
