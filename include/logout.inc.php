<?PHP
    $msg = null;
    if (isset($_GET['delete']))
        $msg = "?msg=delete";
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../fr/home.php'.$msg);
    exit();

?>