<?PHP
    include_once 'header.php';
?>
    <section class="main-container">
        <div class="main-wrapper">
        <h2 class="h2sign" >Mon compte</h2>
            <form  action="include/modif.inc.php" method="POST">
                <table style="width: 50%;" class="signup-form">
                    <tr id="first" >
                        <td align="right">Prénom :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("first");
                        ?>
                    </tr>
                    <tr id="last" >
                        <td align="right">Nom :</td>
                        <?php
                            include_once 'readonly.php';
                            modif("last");
                        ?>
                    </tr>
                    <tr id="email">
                        <td align="right">E-mail :</td>
                        <?php
                            if ($_GET['modif'] == "email")
                            {
                                include_once 'modif.php';
                            }
                            else
                            {
                                include_once 'readonly.php';
                                modif("email");
                            }
                        ?>
                    </tr>
                    <tr id="uid">
                        <td align="right">Nom d'utilisateur :</td>
                        <?php
                            if ($_GET['modif'] == "uid")
                            {
                                include_once 'modif.php';
                            }
                            else
                            {
                                include_once 'readonly.php';
                                modif("uid");
                            }
                        ?>
                    </tr>
                    <?php
                        include_once 'modif_pwd.php';
                    ?>
                </table>
            </form>
        </div>
    </section>
    <script type="text/javascript">
    var erreur = <?PHP echo json_encode($_SESSION['erreur']); ?>;
    var get = <?PHP echo json_encode($_GET); ?>;
        $(document).ready(function () 
        {
            if (get['modif'])
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
    </script>
<?PHP
//print_r($_SESSION);
//print("la");
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