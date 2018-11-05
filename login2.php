<link rel="stylesheet" href="login2.css" type="text/css">
<div class="message">
<form id="login" action="include/login.inc.php" method="POST">
    <table class="login">
        <tr>
            <td>
                <input id="_login_uid" type="text" name="uid" placeholder="Username/e-mail"
                        value="<?php 
                            if(isset($_SESSION['uid'])) 
                            {
                                    if (isset($_GET['login']) && $_GET['login'] === "error") 
                                        echo $_SESSION['uid'];
                                    if (isset($_GET['reset']) && $_GET['reset'] != "error" && isset($_GET['signup']) && $_GET['signup'] != "error")
                                        $_SESSION['uid'] = "";
                            } ?>">
            </td>
            <td>
                <input id="_login_pwd" type="password" name="pwd" placeholder="Password"
                    value="<?php 
                            if(isset($_SESSION['pwd'])) 
                            { 
                                if (isset($_GET['login']) && $_GET['login'] === "error") 
                                    echo $_SESSION['pwd']; 
                                $_SESSION['pwd'] = "";
                            } ?>">
            </td>
            <td>
                <button type="submit" name="submit">Login</button>
            </td>
        </tr>
    </table>
</form>
    <script type="text/javascript">
    var erreur = <?PHP if (isset($_SESSION['erreur'])) echo json_encode($_SESSION['erreur']); else echo "null";?>;
    var get = <?PHP if (isset($_GET)) echo json_encode($_GET); else echo "null"; ?>;
        $(document).ready(function () 
        {
            if (erreur && get['login'])
            {
                $.each(erreur,function(index,element)
                {
                    $("#_login_"+index).css('backgroundColor', 'rgba(248, 207, 72, 0.3)');
                })
            }
        })
    </script>
</div>