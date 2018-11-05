<html>
    <head>
        <title>Camagru</title>
        <link rel="stylesheet" type="text/css" href="home.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body>     
<?php
    include_once 'header.php';
    if (isset($_GET['login']))
    {
        include_once 'login2.php';
    }
    if (isset($_SESSION['erreur']))
    {
        include_once 'error_message.php';
    }
    include_once 'galery2.php';
?>
    </body>
</html>