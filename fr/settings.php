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
        <h2>Thème</h2>
        <form action="/action_page.php" method="post">
        <table>
        <tr>
            <td><input type="checkbox" name="theme" value="basic" checked onchange='this.form.submit()'> Basic</td>
            <td><input type="checkbox" name="theme" value="bulles" onchange='this.form.submit()'> Bulles</td>
        </tr>
        </table>
        </form>
        <h2 class="titre">Langage</h2>
        <form action="/action_page.php" method="post">
        <table>
        <tr>
            <td><input type="checkbox" name="langage" value="fr" checked onchange='this.form.submit()'> fr</td>
            <td><input type="checkbox" name="langage" value="en" onchange='this.form.submit()'> en</td>
        </tr>
        </table>
        </form>
        <h2 class="titre">Notifications</h2>
        <form action="/action_page.php" method="post">
        <table>
        <tr>
            <td><input type="checkbox" name="langage" value="fr" checked onchange='this.form.submit()'> Oui</td>
            <td><input type="checkbox" name="langage" value="en" onchange='this.form.submit()'> Non</td>
        </tr>
        </table>
        </form>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>