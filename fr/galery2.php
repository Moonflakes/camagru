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
    <div class="grid">
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
        foreach ($result->data as $key => $array) 
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
                    if ($key === 'picture_path')
                        $path = $value;
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
                }
            }
            if ($path)
            {
?>
        <div class="item_photo">
            <div class="content_item">
            <!--    <img class="pince" src="../img_site/pince.png" alt="pince"> -->
                <figure>
                    <img src="<?php echo $path;?>" alt="photo">
                    <figcaption><big><?php echo $descr;?></big></figcaption>
                </figure>
                <div class="desc">
                    <div class="nb">
                        <div class="nblike"><small><b><?php echo $nblike;?></b> J'aime</small></div>
                        <div class="nbcom"><small><b><?php echo $nbcom;?></b> Commentaires</small></div>
                    </div>
                    <div class="vide"></div>
                    <div class="action">
                        <form action="../include/like.php" method="POST">
                            <input name="nblike" type="hidden" value="<?php echo $nblike;?>">
                            <button type="submit" name="<?php if ($like === 1) echo "unlike"; else echo "like"; ?>" value="<?php echo $id;?>">
                                <img src="<?php if ($like === 1) echo "../img_site/icones/coeur_rose.png"; else echo "../img_site/icones/coeur.png"; ?>" 
                                    alt="like" title="<?php if ($like === 1) echo "Je n'aime pas"; else echo "J'aime"; ?>"></button>
                        </form>
                    </div>
                    <div class="action">
                        <form action="../include/comment.inc.php" method="POST">
                            <button type="submit" name="comment" value="<?php echo $id;?>">
                                <img src="../img_site/icones/bulle_dialogue.png" alt="comment" title="Commenter">
                            </button>
                        </form>
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
<script>
    function resizeGridItem(item){
    grid = document.getElementsByClassName("grid")[0];
    rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
    rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
    rowSpan = Math.ceil((item.querySelector('.content_item').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
      item.style.gridRowEnd = "span "+rowSpan;
  }
  
  function resizeAllGridItems(){
    allItems = document.getElementsByClassName("item_photo");
    for(x=0;x<allItems.length;x++){
      resizeGridItem(allItems[x]);
    }
  }
  
  function resizeInstance(instance){
      item = instance.elements[0];
    resizeGridItem(item);
  }
  
  window.onload = resizeAllGridItems();
  window.addEventListener("resize", resizeAllGridItems);
  
  allItems = document.getElementsByClassName("item_photo");
  for(x=0;x<allItems.length;x++){
    imagesLoaded( allItems[x], resizeInstance);
  }
    </script>
</section>