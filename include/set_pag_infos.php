<?php

if (isset($_POST['nb_items']))
{
    $nb_img_pg = $_POST['nb_items'];
    if (isset($_GET['page']))
        $num_pg = $_GET['page'];
    else
        $num_pg = 0;
}
else
{
    $nb_img_pg = 10;
    $num_pg = 0;
}
header("Location: ../fr/home.php?limit=$nb_img_pg");
exit();
?>