<?PHP
include_once '../config/setup.php';
session_start();
if (isset($_POST['action']))
{
    $action = $_POST['action'];
    $id = $_POST['id'];

    if ($action === "trash")
    {
        //delete pict
        $reqdelpict = 'DELETE FROM `pictures` WHERE `picture_id`= ?';
        $connexion->prepare($reqdelpict)->execute(array($id));
    }
    $arr = array("action" => $action, "id" => $id);
}
else
{
    print("il n'y a pas de post");
    $arr = array("arr" => "blabla");
}
echo json_encode($arr);

?>