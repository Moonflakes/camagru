<?php
if (isset($_GET))
{

}
else
{
    $_SESSION['erreur']['connect'] = "Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté";
    header("Location: ../index.php?connect=error");
    exit();
}
?>