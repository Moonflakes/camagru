<link rel="stylesheet" href="../css/user_galery.css" type="text/css">
<link rel="stylesheet" href="../css/pagination.css" type="text/css">
<div class="grid" id="grid">
<?php
    include_once '../config/setup.php';
    include_once '../include/paginator.php';

    if (!isset($_SESSION['u_id'])) {
        $_SESSION['erreur']['connect'] = "Pour prendre vos propres photos à votre guise connectez vous !";
        header('Location: ../fr/home.php?login=ask');
    }
    
    $query = "SELECT * FROM pictures WHERE `picture_author`=".$_SESSION['u_id']; // requete sql
    
    $limit = (isset($_GET['limit'])) ? $_GET['limit'] : "all"; // nombre de d'image par page (par defaut 5)
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
            $id = 0;
            if (is_array($array))
            {
                foreach ($array as $key => $value) 
                {
                    if ($key === 'picture_path')
                        $path = str_replace(' ', '+', $value);
                    if ($key === 'picture_description')
                        $descr = $value;
                    if ($key === 'picture_id')
                        $id = $value;
                }
            }
            if ($path)
            {
?>
        <div class="item_photo" id="pict_<?php echo $id;?>">
            <div class="content_item" id="content_<?php echo $id;?>">
                <figure>
                    <img class="my_photo" id="photo_<?php echo $id;?>" src="<?php echo $path;?>" alt="photo">
                    <figcaption><small><?php echo $descr;?></small></figcaption>
                    <div class="action" id="action_<?php echo $id;?>">
                        <a href="<?php echo $path;?>" class="ref" download="img_galerie.png">
                            <img class="img_action" id="img_load_<?php echo $id;?>" src="../img_site/icones/icons8-télécharger-100.png" alt="load" title="Télécharger">
                        </a><br/>
                        <button type="submit" class="img_action but_act trash_but" id="trash_<?php echo $id;?>" name="trash" value="<?php echo $id;?>">
                            <img id="img_trash_<?php echo $id;?>" src="../img_site/icones/trash.png" alt="trash" title="Supprimer"></button>
                        <button type="submit" class="img_action but_act share_but" id="share_<?php echo $id;?>" name="share" value="<?php echo $id;?>">
                            <img id="img_share_<?php echo $id;?>" src="../img_site/icones/icons8-partager-500 (1).png" 
                                alt="share" title="Partager"></button>
                    </div>
                                    
                </figure>
            </div>
        </div>
<?php
            }
        }
    }
?>
    </div>
    <script>
        function resize_item() {
            var content_item = document.getElementsByClassName('content_item'),
                item = document.getElementsByClassName('item_photo'),
                action = document.getElementsByClassName('action'),
                h_content = [];
            Array.from(content_item).forEach(function(element) {
                h_content.push(element.clientHeight);
            });
            Array.from(item).forEach(function(element, index) {
                element.style.height = h_content[index];
            });
            Array.from(action).forEach(function(element) {
                var h_load = (element.clientHeight * 40/100);
                if (element.clientHeight > 190)
                    h_load = 71;
                console.log(h_load, element)
                element.style.paddingTop = ((element.clientHeight - (2 * h_load)) / 2) - 7;
            });
        }
        window.addEventListener('load', resize_item, false);
    </script>
<?php
    echo $paginator->createLinks($links, 'pagination');
?>