<?PHP
session_start();
if (isset($_POST['submit']))
{
    print_r($_POST);
    die();
}
else
{
    print("il n'y a pas de post");
    die();
}

?>