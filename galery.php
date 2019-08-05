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
    if(isset($_SESSION['pict_1']['p_id']))
    {
        foreach ($_SESSION as $key => $array) 
        {
            $path = 0;
            $descr = 0;
            $nblike = 0;
            $nbcom = 0;
            $id = 0;
            $like = 0;
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
                    if ($key === 'p_id')
                        $id = $value;
                    if ($key === 'p_like')
                        $like = $value;
                }
            }
            if ($path)
            {
?>
            <div class="responsive" style="position: relative">
            <img src="img_site/pince.png" alt="pince" style="width:50; position: absolute; left:25px; top: -40px;">
                <div class="gallery" style="padding-top:7; padding-left:7; padding-right:7; background-color: white;">
                    <img src="<?php echo $path;?>" alt="Forest">
                    <div class="desc">
                        <div><big><?php echo $descr;?></big></div>
                        <div class="cont">
                            <div class="infos">
                                <div style="color:ee2e87"><small><b><?php echo $nblike;?></b> J'aime</small></div>
                                <div style="color:#308568"><small><b><?php echo $nbcom;?></b> Commentaires</small></div>
                            </div>
                            <div class="vide"></div>
                            <div class="action">
                                <form action="include/like.php" method="POST">
                                    <input name="nblike" type="hidden" value="<?php echo $nblike;?>">
                                    <button type="submit" name="<?php if ($like === 1) echo "unlike"; else echo "like"; ?>" value="<?php echo $id;?>"
                                        style="border:none; padding: unset;">
                                        <img src="<?php if ($like === 1) echo "img_site/icones/coeur_rose.png"; else echo "img_site/icones/coeur.png"; ?>" 
                                            style="width:30; cursor: pointer;" alt="like" 
                                            title="<?php if ($like === 1) echo "Je n'aime pas"; else echo "J'aime"; ?>"></button>
                                </form>
                            </div>
                            <div class="action">
                                <form action="include/comment.php" method="POST">
                                <button type="submit" name="comment" value="<?php echo $id;?>"
                                        style="border:none; padding: unset;">
                                        <img src="img_site/icones/bulle_dialogue.png" alt="comment" title="Commenter"
                                            style="width:30; cursor: pointer;"></button>
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