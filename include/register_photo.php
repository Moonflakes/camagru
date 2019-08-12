<?PHP
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['submit']) && isset($_POST['pict']))
    {
        $path = htmlspecialchars($_POST['pict']);
        $descr = htmlspecialchars($_POST['descr']);
        $id = htmlspecialchars($_SESSION['u_id']);
        $submit = htmlspecialchars($_POST['submit']);
        // insert comment
        $reqinspict = 'INSERT INTO `pictures`(`picture_id`, `picture_author`, `picture_date`, `picture_path`, `picture_description`) 
        VALUES (?, ?, NOW(), ?, ?)';
        $connexion->prepare($reqinspict)->execute(array(0, $id, $path, $descr));

        $reqid = "SELECT `picture_id` AS `id` FROM `pictures` WHERE `picture_path` = ?";
        $req = $connexion->prepare($reqid);
        $req->execute(array($path));
        $id = $req->fetch();

        $arr = array("submit" => $submit, "descr" => $descr, "path" => $path, "id" => $id['id']);
    }
    else
    {
        $arr = array("arr" => "il n'y a pas de post");
    }
}
echo json_encode($arr);

?>