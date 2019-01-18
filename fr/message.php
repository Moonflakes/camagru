<link rel="stylesheet" type="text/css" href="../css/message.css">
<div class="message">
    <?php
    //supprimer le message d'erreur de login
    if (isset($_SESSION['erreur']))
    {
        foreach ($_SESSION['erreur'] as $key => $value)
        {
            echo '<font color="red">'.$value.'</font></br>';
            if ($key == "uid")
                echo "<font color='blue'>Si vous n'être pas encore inscrit, inscrivez-vous en cliquant sur Inscription !</font></br>";
            if ($key == "pwd")
                echo "<font color='blue'><a href='forgot_pwd.php' id='fpwd-link'>Mot de passe oublié</a></font></br>";
        }
        unset($_SESSION['erreur']);
    }
    if (!isset($_SESSION['u_id']))
    {
        echo '<p>Pour ajouter vos propres photos à la galerie connectez vous !</p>';
    }
    ?>
</div>