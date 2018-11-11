<html>
    <head>
        <title>Camagru</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/signup.css" type="text/css">
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
    <section class="signup">
            <h2 class="h2sign" >Sign Up</h2>
            <form  action="../include/signup.inc.php" method="POST">
                <table class="signup-form">
                    <tr id="first" >
                        <td>
                            <input id="_first" type="text" name="first" placeholder="Fisrtname" 
                            value="<?php 
                                if(isset($_SESSION['first']) && isset($_GET['signup'])) 
                                { 
                                    echo $_SESSION['first']; 
                                    $_SESSION['first'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr id="last" >
                        <td>
                            <input id="_last" type="text" name="last" placeholder="Lastname" 
                            value="<?php 
                                if(isset($_SESSION['last']) && isset($_GET['signup'])) 
                                {
                                    echo $_SESSION['last']; 
                                    $_SESSION['last'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr id="email">
                        <td>
                            <input id="_email" type="text" name="email" placeholder="E-mail" 
                            value="<?php 
                                if(isset($_SESSION['email']) && isset($_GET['signup'])) 
                                {
                                    echo $_SESSION['email']; 
                                    $_SESSION['email'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr id="uid">
                        <td>
                            <input id="_uid" type="text"  name="uid" placeholder="Username" 
                            value="<?php 
                                if(isset($_SESSION['uid']) && isset($_GET['signup'])) 
                                {
                                    echo $_SESSION['uid'];
                                    $_SESSION['uid'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr id="pwd">
                        <td>
                            <input id="_pwd" type="password" name="pwd" placeholder="Password" 
                            value="<?php 
                                if(isset($_SESSION['pwd']) && isset($_GET['signup'])) 
                                {
                                    echo $_SESSION['pwd'];
                                    $_SESSION['pwd'] = "";
                                } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit">Sign up</button>
                        </td>
                    </tr>
                </table>
            </form>
    </section>
    <script type="text/javascript">
    var erreur = <?PHP if (isset($_SESSION['erreur'])) echo json_encode($_SESSION['erreur']);
                        else echo "null"; ?>;
    var get = <?PHP if (isset($_GET)) echo json_encode($_GET);
                        else echo "null";; ?>;
        $(document).ready(function () 
        {
            if (erreur && get['signup'])
            {
                $.each(erreur,function(index,element)
                {
                    $("#"+index).after("<tr><td><font color='red'>"+ element +"</font></td></tr>");
                    $("#_"+index).css('backgroundColor', 'rgba(255, 238, 181, 0.8)');
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
    </body>
</html>