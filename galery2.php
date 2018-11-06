<link rel="stylesheet" href="galery2.css" type="text/css">
<div class="galery">
<?php
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
            <div class="responsive">
                <img class="pince" src="img_site/pince.png" alt="pince">
                <div class="pictures">
                    <img src="<?php echo $path;?>" alt="Forest" width="600" height="400">
                    <div class="infos">
                        <div><big><?php echo $descr;?></big></div>
                        <div class="cont">
                            <div class="nb">
                                <div class="nblike"><small><b><?php echo $nblike;?></b> J'aime</small></div>
                                <div class="nbcom"><small><b><?php echo $nbcom;?></b> Commentaires</small></div>
                            </div>
                            <div class="vide"></div>
                            <div class="action">
                                <form action="include/like.php" method="POST">
                                    <input name="nblike" type="hidden" value="<?php echo $nblike;?>">
                                    <button type="submit" name="<?php if ($like === 1) echo "unlike"; else echo "like"; ?>" value="<?php echo $id;?>">
                                        <img src="<?php if ($like === 1) echo "img_site/icones/coeur_rose.png"; else echo "img_site/icones/coeur.png"; ?>" 
                                            alt="like" title="<?php if ($like === 1) echo "Je n'aime pas"; else echo "J'aime"; ?>"></button>
                                </form>
                            </div>
                            <div class="action">
                                <form action="include/comment.php" method="POST">
                                <button type="submit" name="comment" value="<?php echo $id;?>">
                                        <img src="img_site/icones/bulle_dialogue.png" alt="comment" title="Commenter">
                                </button>
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
</div>