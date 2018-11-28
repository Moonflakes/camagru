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
            <form method="POST">
                <label for="comment">Commentaire :</label>
                <br>
                <textarea class="form-control" id="comment" name="comment"></textarea>
                <button type="submit" id="button" name="envoyer" value="<?php echo $id_pict;?>">Envoyer</button>
            </form>
        </div>
        <div class="talkbubble">
            <div class="old">
<?PHP
    include_once 'old_comments.php';
?>
            </div>
        </div>
    </section>
<?PHP
    include_once 'footer.php';
?>
    <script>
        $(document).ready(function(){
            $("#button").click(function(e){
                e.preventDefault();
                
                $.post(
                    '../include/add_comment.php', 
                    {
                        text : $("#comment").val(),
                        id_pict : $("#button").val()
                    },
        
                    function(data){
                        var author = data['author'];
                        console.log(author);
                        var text = data['text'];
                        console.log(text);
                        var time = data['time'];
                        console.log(time);
                        var id = data['id']
                        console.log(id);
                        var id_next = data['id_next'];
                        console.log(id_next);
                        $(".old-msg_"+id_next).before('<div class="old-msg_'+id+'"><div class="msg"><b>'+author+'</b><span> : '+text+'</span></div><span class="time" id="time_'+id+'">il y a '+time[0]+'</span></div><br>');
                        $.each(time,function(index,element){
                            $('#time_'+index).text(element);
                        });
                
                    },
                    'json'
                );
            });
        });
    </script> 
    </body>
</html>