<?php

$mysqli = new msqly(host, user, pass, db);

$query = select * from pictures; // requete sql

$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 5; // nombre de d'image par page (par defaut 5)
$page = (isset($_GET['page'])) ? $_GET['page'] : 1; // num de page
$links = 5; // links between ...


$paginator = new Paginator($mysqli, $query); // contructor called
$result = $paginator->getData($limit, $page);

//print_r($result->data);
echo $paginator->createLinks($links, 'pagination pagination-sm');

?>
<div class='main-container'>
<?php
    for ($p = 0; $p < count($results->data); $p++)
        $picture = $result->data[$p];
?>
........
</div>