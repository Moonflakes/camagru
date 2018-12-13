<?PHP
session_start();
if (isset($_POST['submit']))
{
    $arr = array("submit" => $_POST['submit'], "cam" => $_POST['camera']);
}
else
{
    print("il n'y a pas de post");
    $arr = array("arr" => "blabla");
}
echo json_encode($arr);

?>