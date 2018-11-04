<?PHP
    session_start();
?>

<html>
    <head>
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body style="font-family:monospace">
		<div id="header">
        <img src="img_site/camera.png" class="image"><a href="index.php"><h1>Camagru</h1></a><img src="img_site/camera_2.png" class="image">
		</div>
        <nav>
            <div class="main-wrapper">
                <div class="nav-login">
                    <a href="index.php">
                        <img src="img_site/icones/home_1.png" alt="home" title="Home"
                                    style="width:50; margin-right: 20px; cursor: pointer;">
                    </a>
                    <a href="settings.php">
                        <img src="img_site/icones/settings_green.png" alt="paramètres" title="Paramètres"
                                    style="width:50; cursor: pointer;">
                    </a>
                    <div style="width:55%"></div>
<?php
    if (isset($_SESSION['u_id']))
    {
        include_once 'logout.php';
    }
    else
    {
        include_once 'login.php';
    }
?>
                </div>
            </div>
        </nav>
    </body>
</html>