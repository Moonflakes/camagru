<link rel="stylesheet" href="../css/user_galery.css" type="text/css">
<link rel="stylesheet" href="../css/pagination.css" type="text/css">
<div class="grid" id="grid">
<?php
    include_once '../config/setup.php';
    include_once '../include/paginator.php';
    
    $query = "SELECT * FROM pictures WHERE `picture_author`=".$_SESSION['u_id']; // requete sql
    
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
        <div class="item_photo" id="item<?php echo ++$i;?>">
            <div class="content_item">
            <!--    <img class="pince" src="../img_site/pince.png" alt="pince"> -->
                <figure>
                    <img src="<?php echo $path;?>" alt="photo">
                    <figcaption><small><?php echo $descr;?></small></figcaption>
                </figure>
            </div>
        </div>
<?php
            }
        }
    }
?>
    </div>
<?php
    echo $paginator->createLinks($links, 'pagination');
?>