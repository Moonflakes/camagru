<?PHP
session_start();
if (isset($_POST['submit']))
{
    $b = json_decode($_POST['top']);
    $arr = array("submit" => $_POST['submit'], /*"cam" => $_POST['camera']*/
    "name" => $_POST['name'], "top" => $_POST['top'], 
    "left" => $_POST['left'], "width" => $_POST['width'], "height" => $_POST['height']);
}
else
{
    print("il n'y a pas de post");
    $arr = array("arr" => "blabla");
}
echo json_encode($arr);

?>