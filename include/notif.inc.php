<?php
include_once '../config/setup.php';
session_start();
include_once 'check_user.php';
if (isset($_POST['notifState']))
{
        $id = htmlspecialchars($_SESSION['u_id']);
        $bool = htmlspecialchars($_POST['notifState']) === 'true' ? 1 : 0;
        // update notif state
        $reqnotif = 'UPDATE `users` SET `user_notif`=? WHERE `user_id`=?';
        $connexion->prepare($reqnotif)->execute(array($bool, $id));

        $_SESSION['u_notif'] = $bool;

        $arr = array("notifState" => $bool);
}
echo json_encode($arr);

?>