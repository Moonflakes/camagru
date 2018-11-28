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
                        <form method="POST">
                            <button type="submit" class="coeur" id="coeur_<?php echo $id;?>" name="like" value="<?php echo $id;?>">
                                <img id="img_coeur_<?php echo $id;?>" src="<?php if ($like === 1) echo "../img_site/icones/coeur_rose.png"; else echo "../img_site/icones/coeur.png"; ?>" 
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
<script type="text/javascript">

function smallH()
{
    tab = Array.prototype.slice.call(arguments);
    return (tab.indexOf(Math.min(...tab)) + 1);
}
        

function organisation(nbcol)
{
    var column;
    var item;
    var i = 0;
    var h1 = 0;
    var h2 = 0;
    var h3 = 0;
    var h4 = 0;

    
    if (nbcol === 1)
    {
        column = document.getElementById('column1');
        //mettre les éléments dans la div
        while (item = document.getElementById('item'+(++i)))
            column.appendChild(item);
    }
    else if (nbcol === 2)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i == 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i == 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2));
                column.appendChild(item);
                if (smallH(h1, h2) == 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
            }
        }
    }
    else if (nbcol === 3)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i === 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i === 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else if (i === 3)
            {
                column = document.getElementById('column3');
                column.appendChild(item);
                h3 = item.offsetHeight + h3;
                console.log("offsetH item", i," : ", h3, "colonne3");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2, h3));
                column.appendChild(item);
                if (smallH(h1, h2, h3) === 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else if (smallH(h1, h2, h3) === 2)
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
                else
                {
                    h3 = item.offsetHeight + h3;
                    console.log("offsetH item", i," : ", h3, "colonne3");
                }
            }
        }
    }
    else if (nbcol === 4)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i === 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i === 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else if (i === 3)
            {
                column = document.getElementById('column3');
                column.appendChild(item);
                h3 = item.offsetHeight + h3;
                console.log("offsetH item", i," : ", h3, "colonne3");
            }
            else if (i === 4)
            {
                column = document.getElementById('column4');
                column.appendChild(item);
                h4 = item.offsetHeight + h4;
                console.log("offsetH item", i," : ", h4, "colonne4");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2, h3, h4));
                column.appendChild(item);
                if (smallH(h1, h2, h3, h4) === 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else if (smallH(h1, h2, h3, h4) === 2)
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
                else if (smallH(h1, h2, h3, h4) === 3)
                {
                    h3 = item.offsetHeight + h3;
                    console.log("offsetH item", i," : ", h3, "colonne3");
                }
                else
                {
                    h4 = item.offsetHeight + h4;
                    console.log("offsetH item", i," : ", h4, "colonne4");
                }
            }
        }
    }
}

function createColumns(largeur)
{
    var grid = document.getElementById("grid");
    var column1 = document.getElementById('column1');
    var column3 = document.getElementById('column3');
    var column2 = document.getElementById('column2');
    var column4 = document.getElementById('column4');
    var nbcol = 0;

    if (column1 == undefined)
    {
        column1 = document.createElement('div');
        column1.setAttribute("id", "column1");
        column1.setAttribute("class", "column");
        grid.appendChild(column1);
        nbcol = 1;
    }
    if (column2 == undefined)
    {
        if (largeur > 700)
        {
            //create column
            column2 = document.createElement('div');
            column2.setAttribute("id", "column2");
            column2.setAttribute("class", "column");
            grid.appendChild(column2);
            nbcol = 2;
        }
    }
    else
    {
        if (largeur < 700)
        {
            // reorganisation 
            organisation(1);
            
            //remove column
            grid.removeChild(column2);
            if (column3)
                grid.removeChild(column3);
            if (column4)
                grid.removeChild(column4);
            return;
        }
    }
    if (column3 == undefined)
    {
        if (largeur > 1300)
        {
            column3 = document.createElement('div');
            column3.setAttribute("id", "column3");
            column3.setAttribute("class", "column");
            grid.appendChild(column3);
            nbcol = 3;
        }
    }
    else
    {
        if (largeur < 1300)
        {
            // reorganisation 
            organisation(2);

            // remove column
            grid.removeChild(column3);
            if (column4)
                grid.removeChild(column4);
            return;
        }
    }
    if (column4 == undefined)
    {
        if (document.body.clientWidth > 1700)
        {
            column4 = document.createElement('div');
            column4.setAttribute("id", "column4");
            column4.setAttribute("class", "column");
            grid.appendChild(column4);
            nbcol = 4;
        }
    }
    else
    {
        if (document.body.clientWidth < 1700)
        {
            // reorganisation 
            organisation(3);

            // remove column
            grid.removeChild(column4);
            return;
        }
    }
    organisation(nbcol);
}


window.addEventListener('load',function(){
    var largeur = document.body.clientWidth;
       
    createColumns(largeur);

//controler la largeur de la fenetre
    this.addEventListener('resize',function(){
        largeur = document.body.clientWidth;
        createColumns(largeur);
    });
});
	</script>
<script>
 
$(document).ready(function(){
var src_like = '../img_site/icones/coeur_rose.png';
var src_unlike = '../img_site/icones/coeur.png';
var nblike = $('#nblike').text();
    $(".coeur").click(function(e){
        e.preventDefault();
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");
        var id = split_id[1];
        
        $.post(
            '../include/like.php', 
            {
                like : $("#coeur_"+id).val()
            },
  
            function(data){
                var nblike = data['nb_likes'];
                var type = data['type'];
                var id = data['id'];
                
                if(type == 'like'){
                    // mettre le coeur en rose
                    $("#img_coeur_"+id).attr('src', src_like);
                    $("#img_coeur_"+id).attr('title', "Je n'aime pas");
                    $('#nblike_'+id).text(nblike);
                }
                else if (type == 'unlike'){
                    // mettre le coeur vide
                    $("#img_coeur_"+id).attr('src', src_unlike);
                    $("#img_coeur_"+id).attr('title', "J'aime");
                    $('#nblike_'+id).text(nblike);
                }
          
            },
            'json'
        );
    });
});
  
</script>
</section>