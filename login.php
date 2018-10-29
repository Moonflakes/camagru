<?PHP
    session_start();
?>

<form id="login" action="include/login.inc.php" method="POST">
    <table class="login">
        <tr>
            <td>
                <input id="_login_uid" type="text" name="uid" placeholder="Username/e-mail" 
                    value="<?php 
                            if(isset($_SESSION['uid'])) 
                            { 
                                if ($_GET['login'] == "error") 
                                    echo $_SESSION['uid']; 
                                $_SESSION['uid'] = "";
                            } ?>">
            </td>
            <td>
                <input id="_login_pwd" type="password" name="pwd" placeholder="Password" 
                    value="<?php 
                            if(isset($_SESSION['pwd'])) 
                            { 
                                if ($_GET['login'] == "error") 
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
<a href="signup.php" id="signup-link">Sign up</a>
    <script type="text/javascript">
    var erreur = <?PHP echo json_encode($_SESSION['erreur']); ?>;
    var get = <?PHP echo json_encode($_GET) ?>;
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
