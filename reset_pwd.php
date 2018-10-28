<?PHP
    include_once 'header.php';
?>
    <section class="main-container">
        <div class="main-wrapper">
            <h2 class="h2sign" >Réinitialisation du mot de passe</h2>
            <form  action="include/reset_pwd.inc.php" method="POST">
                <table class="signup-form">
                    <tr id="uid">
                        <td>
                            <input id="_uid" type="text"  name="uid" placeholder="Username" 
                            value="<?php 
                                if(isset($_GET['uid'])) 
                                { 
                                    echo $_GET['uid']; 
                                } ?>">
                        </td>
                    </tr>
                    <tr id="pwd">
                        <td>
                            <input id="_pwd" type="password" name="pwd" placeholder="New password" 
                            value="<?php 
                                if(isset($_SESSION['pwd'])) 
                                { 
                                    echo $_SESSION['pwd']; 
                                    $_SESSION['pwd'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit">Réinitialiser</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <script type="text/javascript">
    var erreur = <?PHP echo json_encode($_SESSION['erreur']); ?>;
        $(document).ready(function () 
        {
            if (erreur)
            {
                $.each(erreur,function(index,element)
                {
                    $("#"+index).after("<tr><td><font color='red'>"+ element +"</font></td></tr>");
                    $("#_"+index).css('backgroundColor', 'rgba(248, 207, 72, 0.3)');
                })
            }
        })
    </script>
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