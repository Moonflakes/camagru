<html>
    <head>
        <title>Camagru</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/account.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        body
        {
            font-family: monospace;
        }
    </style>
    <body> 
<?PHP
    include_once 'header.php';
?>
    <section class="account">
        <h2 class="h2sign" >Mon compte</h2>
            <table style="width: 50%;" class="account-form">
                <form method="POST">
                    <tr id="first" >
                        <td align="right">Prénom :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("first");
                        ?>
                    </tr>
                </form>
                <form method="POST">
                    <tr id="last" >
                        <td align="right">Nom :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("last");
                        ?>
                    </tr>
                </form>
                <form method="POST">
                    <tr id="email">
                        <td align="right">E-mail :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("email");
                        ?>
                    </tr>
                </form>
                <form method="POST">
                    <tr id="uid">
                        <td align="right">Nom d'utilisateur :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("uid");
                        ?>
                    </tr>
                </form>
                <form id="form_pwd" method="POST">
                    <?php
                        include_once 'modif_pwd.php';
                    ?>
                </form>
            </table>
            </form>
    </section>
    <script src="../js/account.js"></script>
   <!-- <script type="text/javascript">
    var erreur = <?PHP if (isset($_SESSION['erreur'])) echo json_encode($_SESSION['erreur']);
                        else echo "null"; ?>;
    var get = <?PHP if (isset($_GET)) echo json_encode($_GET);
                        else echo "null"; ?>;
        $(document).ready(function () 
        {
            if (get['modif'] && !erreur)
            {
                if (get['modif'] == "pwd")
                {
                    $("#_oldpwd").css('backgroundColor', 'rgba(255, 238, 181, 0.8)');
                    $("#_newpwd").css('backgroundColor', 'rgba(255, 238, 181, 0.8)');
                }
                else
                    $("#_"+get['modif']).css('backgroundColor', 'rgb(255, 238, 181, 0.8)');
            }
            if (erreur && get['error'])
            {
                $.each(erreur,function(index,element)
                {
                    $("#_"+index).css('backgroundColor', 'rgba(255, 238, 181, 0.8)');
                    $("#"+index).after("<tr><td></td><td style='padding-left:12px' colspan='2'><font color='red'>"+ element +"</font></td></tr>");
                })
            }
        })
    </script> -->
<?PHP
    if(isset($_SESSION['erreur']))
        unset($_SESSION['erreur']);
    else if (isset($_SESSION['success']))
    {
        echo '<font color="red">'.$_SESSION['success'].'</font>';
        unset($_SESSION['success']);
    }
?>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>