
<div class="message">
    <?php
    //supprimer le message d'erreur de login
    if (isset($_GET['msg']) && $_GET['msg'] == "delete") {
        echo '<p><font color="red">Votre compte à bien été supprimé.</font></p>';
    }
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
    else if (!isset($_SESSION['u_id']))
    {
        echo '<p>Pour ajouter vos propres photos à la galerie, ajouter des commentaires et liker vos photos préférées connectez vous !</p>';
    }
    ?>
</div>