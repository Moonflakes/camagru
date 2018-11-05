<link rel="stylesheet" type="text/css" href="error.css">
<div class="error-message">
    <?php
    //supprimer le message d'erreur de login
    foreach ($_SESSION['erreur'] as $key => $value)
    {
        echo '<font color="red">'.$value.'</font></br>';
        if ($key == "uid")
            echo "<font color='blue'>Si vous n'être pas encore inscrit, inscrivez-vous en cliquant sur Sign up !</font></br>";
        if ($key == "pwd")
            echo "<font color='blue'><a href='forgot_pwd.php' id='fpwd-link'>Mot de passe oublié</a></font></br>";
    }
    unset($_SESSION['erreur']);
    ?>
</div>