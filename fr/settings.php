<?php
// if (!isset($_SESSION['u_id']) && !isset($_GET['session'])) {
// 	header('Location: ../fr/home.php?login=ask');
// }
?>
<html>
    <head>
        <title>Camagru - Paramètres</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/settings.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        body
        {
            font-family: monospace;
        }
    </style>
    <body> 
<?PHP
    include_once 'header.php';
    include_once 'user_settings.php';
    include_once 'footer.php';
?>
    </body>
</html>
<script src="../js/notif.js"></script>