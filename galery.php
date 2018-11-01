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
        <a target="_blank" href="photos/swaggy_photo.png">
        <img src="photos/swaggy_photo.png" alt="Cinque Terre" width="600" height="400">
        </a>
        <div class="desc">Add a description of the image here</div>
    </div>
    </div>


    <div class="responsive">
    <div class="gallery">
        <a target="_blank" href="photos/img_forest.jpg">
        <img src="photos/img_forest.jpg" alt="Forest" width="600" height="400">
        </a>
        <div class="desc">
            <div class="element">Add a description of the image here</div>
            <div class="cont">
                <div class="action">
                    <form>
                        <input type="image" width="auto" height="25" alt="like" title="J'aime"
                            src="background/coeur.png">
                    </form>
                </div>
                <div class="action">
                    <form>
                        <input type="image" width="auto" height="30" alt="comment" title="Commenter"
                            src="background/bulle_dialogue.png">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="clearfix"></div>
