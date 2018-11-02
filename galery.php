<?php
    if (isset($_SESSION['u_id']))
    {
        echo '<a href="webcam.php?uid='.$_SESSION['u_uid'].'&key='.$_SESSION['u_key'].'"><p>Ajouter</p></a>';
    }
    else
    {
        echo '<p>Pour ajouter vos propres photos à la galerie connectez vous !</p>';
    }
?>
    <div class="responsive">
    <div class="gallery">
        <img src="photos/swaggy.png" alt="Cinque Terre" width="600" height="400">
        <div class="desc">Add a description of the image here</div>
    </div>
    </div>


    <div class="responsive">
    <div class="gallery">
        <img src="photos/img_forest.jpg" alt="Forest" width="600" height="400">
        <div class="desc">
            <div>Add a description of the image here</div>
            <div class="cont">
                <div class="infos">
                    <div>4 J'aime</div>
                    <div>5 Commentaires</div>
                </div>
                <div class="vide"></div>
                <div class="action">
                    <form action="include/like.php" method="POST">
                        <input type="image" width="auto" height="25" alt="like" title="J'aime"
                            src="background/coeur.png">
                    </form>
                </div>
                <div class="action">
                    <form action="include/comment.php" method="POST">
                        <input type="image" width="auto" height="30" alt="comment" title="Commenter"
                            src="background/bulle_dialogue.png">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="clearfix"></div>
