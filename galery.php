<?php
    if (isset($_SESSION['u_id']))
    {
        echo '<a href="webcam.php?uid='.$_SESSION['u_uid'].'&key='.$_SESSION['u_key'].'"><p>Ajouter</p></a>';
    }
    else
    {
        echo '<p>Pour ajouter vos propres photos à la galerie connectez vous !</p>';
    }
    include_once 'include/set_pict_infos.php';
    if(isset($_SESSION[0]['p_id']))
    {
        foreach ($_SESSION as $key => $array) 
        {
            $path = 0;
            $descr = 0;
            $nblike = 0;
            $nbcom = 0;
            if (is_array($array))
            {
                foreach ($array as $key => $value) 
                {
                    if ($key === 'p_path')
                        $path = $value;
                    if ($key === 'p_descr')
                        $descr = $value;
                    if ($key === 'p_nblike')
                        $nblike = $value;
                    if ($key === 'p_nbcom')
                        $nbcom = $value;
                }
            }
            if ($path)
            {
?>
            <div class="responsive">
                <div class="gallery">
                    <img src="<?php echo $path;?>" alt="Forest" width="600" height="400">
                    <div class="desc">
                        <div><?php echo $descr;?></div>
                        <div class="cont">
                            <div class="infos">
                                <div><?php echo $nblike;?> J'aime</div>
                                <div><?php echo $nbcom;?> Commentaires</div>
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
<?php
            }
        }
    }
?>
    <div class="clearfix"></div>