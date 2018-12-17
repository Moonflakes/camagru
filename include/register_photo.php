<?PHP
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';

if (check_user_is_connect($connexion))
{
    if (isset($_POST['submit']) && isset($_POST['pict']))
    {
        $path = $_POST['pict'];
        $descr = $_POST['descr'];
        // insert comment
        $reqinspict = 'INSERT INTO `pictures`(`picture_id`, `picture_author`, `picture_date`, `picture_path`, `picture_description`) 
        VALUES (?, ?, NOW(), ?, ?)';
        $connexion->prepare($reqinspict)->execute(array(0, $_SESSION['u_id'], $path, $descr));

        $arr = array("submit" => $_POST['submit'], "descr" => $descr, "path" => $path);
    }
    else
    {
        print("il n'y a pas de post");
        $arr = array("arr" => "blabla");
    }
}
echo json_encode($arr);

?>