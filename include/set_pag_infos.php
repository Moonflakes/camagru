<?php

if (isset($_POST['nb_items']))
{
    $nb_img_pg = $_POST['nb_items'];
    $num_pg = 0;
}
else
{
    $nb_img_pg = 10;
    $num_pg = 0;
}
header("Location: ../fr/home.php?nb_item=$nb_img_pg");
exit();
?>