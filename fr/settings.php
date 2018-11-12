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
            <input type="checkbox" name="theme" value="basic" checked onchange='this.form.submit()'> Basic<br>
            <input type="checkbox" name="theme" value="bulles" onchange='this.form.submit()'> Bulles<br>
        </form>
        <h2>Langage</h2>
        <form action="/action_page.php" method="post">
            <input type="checkbox" name="langage" value="fr" checked onchange='this.form.submit()'> fr<br>
            <input type="checkbox" name="langage" value="en" onchange='this.form.submit()'> en<br>
        </form>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>