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
?>
    <section class="settings">
        <h2 class="titre">Notifications</h2>
        <form>
        <table>
        <tr>
            <td><label class="switch">
            <span><?php echo $_SESSION['u_notif']?></span>
<?php 
if ($_SESSION['u_notif'] === 1) {?>
                <input type="checkbox" id="notif" checked>
<?php }
    else {?>
                <input type="checkbox" id="notif">
<?php   }?>
                <span class="slider round"></span>
            </label></td>
        </tr>
        </table>
        </form>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>
<script src="../js/notif.js"></script>