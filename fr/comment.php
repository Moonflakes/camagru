<html>
    <head>
        <title>Camagru - Commentaires</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/comment.css" type="text/css">
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
    <section class="comment">
        <div class="com-user">
            <img class="image" src="../photos/chalet_leat.jpg" alt="photo">
            <form>
                <label for="comment">Commentaire :</label>
                <br>
                <textarea class="form-control" rows="10" cols="70" id="comment"></textarea>
                <button type="submit" name="envoyer">Envoyer</button>
            </form>
        </div>
        <div class="old-com">
            <img class="com" src="../img_site/icones/com.png" alt="photo">
            <iframe src="old_comments.php"></iframe>
        </div>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>