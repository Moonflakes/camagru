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
    include_once '../config/setup.php';
    include_once '../include/commentator.php';

    $id_pict = (isset($_GET['img'])) ? $_GET['img'] : null;

    $reqpath = "SELECT `picture_path` AS `path` FROM `pictures` WHERE `picture_id`=?";
    $req = $connexion->prepare($reqpath);
    $req->execute(array($id_pict));

    if ($pict = $req->fetch())
        $path = $pict['path'];

?>
    <section class="comment">
        <div class="com-user">
            <img class="image" src="<?php if ($path) echo $path;?>" alt="photo">
            <form>
                <label for="comment">Commentaire :</label>
                <br>
                <textarea class="form-control" id="comment"></textarea>
                <button type="submit" name="envoyer">Envoyer</button>
            </form>
        </div>
        <div class="talkbubble">
<?PHP
    include_once 'old_comments.php';
?>
        </div>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>