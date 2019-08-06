<html>
    <head>
        <title>Camagru - Paramètres</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/settings.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/notif.js"></script>
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
                <input type="checkbox" checked id="notif">
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