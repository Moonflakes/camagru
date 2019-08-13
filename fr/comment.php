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
    include_once 'message.php';
    include_once '../config/setup.php';
    include_once '../include/commentator.php';

    if (isset($_GET['key']) && isset($_SESSION['u_key']) && $_GET['key'] != $_SESSION['u_key']) {
        $_SESSION['erreur']['connect'] = "";
        header('Location: ../include/logout.inc.php');
    }

    if (!$_SESSION['u_uid']) {
        $_SESSION['erreur']['connect'] = "Pour commenter des photos à votre guise connectez vous !";
        header("Location: ../fr/home.php?login=ask");
    }

    $id_pict = (isset($_GET['img'])) ? $_GET['img'] : null;

    $reqpath = "SELECT `picture_path` AS `path` FROM `pictures` WHERE `picture_id`=?";
    $req = $connexion->prepare($reqpath);
    $req->execute(array($id_pict));

    if ($pict = $req->fetch())
        $path = str_replace(' ', '+', $pict['path']);;

?>
    <section class="comment">
        <div class="photo-com">
            <img class="image" src="<?php if ($path) echo $path;?>" alt="photo">
        </div>
        <div class="com-user">
            <form method="POST">
                <label for="comment">Commentaire :</label>
                <br>
                <textarea onkeyup="resize_area(this, 10)" class="form-control" id="comment" name="comment"></textarea>
                <button type="submit" id="button" name="envoyer" value="<?php echo $id_pict;?>">Envoyer</button>
            </form>
            <div class="talkbubble">
                <div class="old">
<?PHP
    include_once 'old_comments.php';
?>
                </div>
            </div>
        </div>
    </section>
<?PHP
    include_once 'footer.php';
?>
    <script src="../js/comment.js"></script>
    <script type="text/javascript">
        function resize_area(obj,minRows){
            var txt = obj.value,
            rows = obj.rows,
            nbRows = txt.split('\n').length;
            if (nbRows > rows){
                obj.rows=obj.rows + 1;
            }
            else if (rows > minRows){
                obj.rows = obj.rows - 1;
            }
        }
    </script>
    </body>
</html>