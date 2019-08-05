<link rel="stylesheet" href="../css/galery2.css" type="text/css">
<link rel="stylesheet" href="../css/pagination.css" type="text/css">
<section class="galery">
    <form name="nbitem_pg" action="../include/set_pag_infos.php?page=<?php if (isset($_GET['page'])) echo $_GET['page']; else echo '1';?>" method="POST">
        Nombre d'items par pages :
        <select name="nb_items" onchange='this.form.submit()'>
            <option value="10" <?php if ((isset($_GET['limit']) && $_GET['limit'] == 10) || !isset($_GET['limit'])) echo "selected"?>>10</option>
            <option value="20" <?php if (isset($_GET['limit']) && $_GET['limit'] == 20) echo "selected"?>>20</option>
            <option value="30" <?php if (isset($_GET['limit']) && $_GET['limit'] == 30) echo "selected"?>>30</option>
            <option value="40" <?php if (isset($_GET['limit']) && $_GET['limit'] == 40) echo "selected"?>>40</option>
        </select>
    </form>
    <div class="grid" id="grid">
<?php
    include_once '../config/setup.php';
    include_once '../include/paginator.php';
    
    $query = "SELECT * from pictures"; // requete sql
    
    $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10; // nombre de d'image par page (par defaut 5)
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1; // num de page
    $links = 5; // links between ...
    
    $paginator = new Paginator($connexion, $query); // contructor called
    $result = $paginator->getData($limit, $page); // set pictures infos
    
    //print_r($result->data);
    if(isset($result->data))
    {
        $i = 0;
        foreach ($result->data as $key => $array) 
        {
            $path = 0;
            $descr = 0;
            $nblike = 0;
            $nbcom = 0;
            $id = 0;
            $like = 0;
            $nbunread = 0;
            if (is_array($array))
            {
                foreach ($array as $key => $value) 
                {
                    if ($key === 'picture_path')
                        $path = str_replace(' ', '+', $value);
                    if ($key === 'picture_description')
                        $descr = $value;
                    if ($key === 'picture_nb_like')
                        $nblike = $value;
                    if ($key === 'picture_nb_comment')
                        $nbcom = $value;
                    if ($key === 'picture_id')
                        $id = $value;
                    if ($key === 'picture_like')
                        $like = $value;
                    if ($key === 'picture_nb_comment_unread')
                        $nbunread = $value;
                }
            }
            if ($path)
            {
?>
        <div class="item_photo" id="item<?php echo ++$i;?>">
            <div class="content_item">
            <!--    <img class="pince" src="../img_site/pince.png" alt="pince"> -->
                <figure>
                    <img src="<?php echo $path;?>" alt="photo">
                    <figcaption><big><?php echo $descr;?></big></figcaption>
                </figure>
                <div class="desc">
                    <div class="nb">
                        <div class="nblike"><small><b id="nblike_<?php echo $id;?>"><?php echo $nblike;?></b> J'aime</small></div>
                        <div class="nbcom"><small><b id="nbcom_<?php echo $id;?>"><?php echo $nbcom;?></b> Commentaires</small></div>
                    </div>
                    <div class="vide"></div>
                    <div class="action">
                        <button type="submit" class="coeur" id="coeur_<?php echo $id;?>" name="like" value="<?php echo $id;?>">
                            <img id="img_coeur_<?php echo $id;?>" src="<?php if ($like === 1) echo "../img_site/icones/coeur_rose.png"; else echo "../img_site/icones/coeur.png"; ?>" 
                                alt="like" title="<?php if ($like === 1) echo "Je n'aime pas"; else echo "J'aime"; ?>"></button>
                    </div>
                    <div class="action">
                        
                            <button type="submit" class="comment" name="comment" value="<?php echo $id;?>">
                                <img src="../img_site/icones/bulle_dialogue.png" alt="comment" title="Commenter">
                                <?php if ($nbunread) {?>
                                <span class="badge"><?php echo $nbunread;?></span>
                                <?php }?>
                            </button>
                        
                    </div>
                </div>
            </div>
        </div>
<?php
            }
        }
    }
?>
    </div>
    <div class="clearfix"></div>
<?php
    echo $paginator->createLinks($links, 'pagination');
?>
<script src="../js/galery.js"></script>
</section>