<?PHP
    include_once 'header.php';
?>
    <section class="main-container">
        <div class="main-wrapper">
            <h2 class="h2sign" >Sign Up</h2>
            <form  action="include/signup.inc.php" method="POST">
                <table class="signup-form">
                    <tr id="first" >
                        <td>
                            <input id="_first" type="text" name="first" placeholder="Fisrtname" 
                            value="<?php if(isset($_SESSION['first'])) { echo $_SESSION['first']; $_SESSION['first'] = "";} ?>">
                        </td>
                    </tr>
                    <tr id="last" >
                        <td>
                            <input id="_last" type="text" name="last" placeholder="Lastname" 
                            value="<?php if(isset($_SESSION['last'])) { echo $_SESSION['last']; $_SESSION['last'] = "";} ?>">
                        </td>
                    </tr>
                    <tr id="email">
                        <td>
                            <input id="_email" type="text" name="email" placeholder="E-mail" 
                            value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; $_SESSION['email'] = "";} ?>">
                        </td>
                    </tr>
                    <tr id="uid">
                        <td>
                            <input id="_uid" type="text"  name="uid" placeholder="Username" 
                            value="<?php if(isset($_SESSION['uid'])) { echo $_SESSION['uid']; $_SESSION['uid'] = ""; } ?>">
                        </td>
                    </tr>
                    <tr id="pwd">
                        <td>
                            <input id="_pwd" type="password" name="pwd" placeholder="Password" 
                            value="<?php if(isset($_SESSION['pwd'])) { echo $_SESSION['pwd']; $_SESSION['pwd'] = "";} ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit">Sign up</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    <script type="text/javascript">
    var erreur = <?PHP echo json_encode($_SESSION['erreur']); ?>;
    var type_erreur = <?PHP echo json_encode($_GET['error']); ?>;
        $(document).ready(function () 
        {
            $("#"+type_erreur).after("<tr><td><font color='red'>"+ erreur +"</font></td></tr>");
            $("#_"+type_erreur).css('backgroundColor', 'rgba(248, 207, 72, 0.3)');
        })
    </script>
<?PHP
    if(isset($_SESSION))
    {
        echo '<font color="red">'.$_SESSION['erreur'].'</font>';
        $_SESSION['erreur'] = "";
    }
?>
<?PHP
    include_once 'footer.php';
?>