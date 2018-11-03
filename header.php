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
        <img src="img_site/licorne7.png" class="image"><a href="index.php"><h1>Camagru</h1></a><img src="img_site/licorne6.png" class="image">
		</div>
        <nav>
            <div class="main-wrapper">
                <div class="nav-login">
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