<?php
/*$tab_chat = unserialize(file_get_contents("../private/chat"));
foreach ($tab_chat as $tab) 
{
    echo "[".date("H:i", $tab['time'])."] "."<b>".$tab['login']."</b>: ".$tab['msg']."<br />\n";
}*/
?>
<?php
    date_default_timezone_set('Europe/Paris');
    include_once '../include/formatime.php';

    $query = "SELECT * from comments WHERE comment_id_pict = $id_pict"; // requete sql
    
    $commentator = new Commentator($connexion, $query); // contructor called
    $result = $commentator->getData(); // set pictures infos
    
    //print_r($result->data);
    if(isset($result->data))
    {
        foreach ($result->data as $key => $array) 
        {
            $date = 0;
            $text = 0;
            $author = 0;
            $id = 0;
            //$like = 0;
            if (is_array($array))
            {
                foreach ($array as $key => $value) 
                {
                    if ($key === 'comment_date')
                    {
                        $date = new DateTime($value);
                        $now = new DateTime("now");
                        $dif_time = date_diff($now, $date);
                        $time = formatime($dif_time);
                    }
                    if ($key === 'comment_text')
                        $text = $value;
                    if ($key === 'comment_author')
                        $author = $value;
                    if ($key === 'comment_id')
                        $id = $value;
                   /* if ($key === 'picture_like')
                        $like = $value;*/
                }
            }
            if ($text)
            {
?>
        <div class="old-msg">
            <div class="msg">
                <b><?php echo $author;?> </b>
                <span> : <?php echo $text;?></span>
            </div>
            <span class="time">il y a <?php echo $time;?></span>
        </div><br>
<?php
            }
        }
    }
?>