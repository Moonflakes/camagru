<?PHP
    include_once 'header.php';
?>
    <section class="main-container">
        <div class="main-wrapper">
            <h2 class="h2sign" >Mon compte</h2>
            <form  action="include/modif.inc.php" method="POST">
                <table style="width: 50%;" 
                        class="signup-form">
                    <tr id="first" >
                        <td align="right">Prénom :</td>
                        <td>
                            <input style="width: 100%; 
                                        margin-left: 10px;
                                        margin-right: 10px;" 
                                    id="_first" type="text" name="first" 
                                    value="<?php 
                                        if(isset($_SESSION['u_first']))
                                            echo $_SESSION['u_first']; ?>" readonly>
                        </td>
                    </tr>
                    <tr id="last" >
                        <td align="right">Nom :</td>
                        <td>
                            <input style="width: 100%;
                                        margin-left: 10px;
                                        margin-right: 10px;" 
                                    id="_last" type="text" name="last" 
                                    value="<?php 
                                        if(isset($_SESSION['u_last']))
                                            echo $_SESSION['u_last']; ?>" readonly>
                        </td>
                    </tr>
                    <tr id="email">
                        <td align="right">E-mail :</td>
                        <td>
                            <input style="width: 100%;
                                        margin-left: 10px;
                                        margin-right: 10px;" 
                                    id="_email" type="text" name="email" 
                                    value="<?php 
                                        if(isset($_SESSION['u_email']))
                                            echo $_SESSION['u_email']; ?>" readonly>
                        </td>
                        <td>
                            <button style="margin-top: 0px;
                                        margin-right: 0px;
                                        width: 84px;
                                        border-left-width: 2px;
                                        padding-bottom: 1px;
                                        margin-left: 10%;" 
                                    type="submit" name="reset_email">Modifier</button>
                        </td>
                    </tr>
                    <tr id="uid">
                        <td align="right">Nom d'utilisateur :</td>
                        <td>
                            <input style="width: 100%;
                                        margin-left: 10px;
                                        margin-right: 10px;" 
                                    id="_uid" type="text" name="uid" 
                                    value="<?php 
                                        if(isset($_SESSION['u_uid']))
                                            echo $_SESSION['u_uid']; ?>" readonly>
                        </td>
                        <td>
                            <button style="margin-top: 0px;
                                        margin-right: 0px;
                                        width: 84px;
                                        border-left-width: 2px;
                                        padding-bottom: 1px;
                                        margin-left: 10%;" 
                                    type="submit" name="reset_uid">Modifier</button>
                        </td>
                    </tr>
                    <tr id="pwd">
                        <td align="right">Mot de passe :</td>
                        <td>
                            <input style="width: 100%;
                                        margin-left: 10px;
                                        margin-right: 10px;" 
                                    id="_pwd" type="text" name="pwd" 
                                    value="<?php 
                                        if(isset($_SESSION['u_pwd']))
                                            echo $_SESSION['u_pwd']; ?>" readonly>
                        </td>
                        <td>
                            <button style="margin-top: 0px;
                                        margin-right: 0px;
                                        width: 84px;
                                        border-left-width: 2px;
                                        padding-bottom: 1px;
                                        margin-left: 10%;" 
                                    type="submit" name="reset_pwd">Modifier</button>
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