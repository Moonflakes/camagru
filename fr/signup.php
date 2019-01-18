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
            <h2 class="h2sign" >Créer un compte</h2>
            
                <table class="signup-form" id="table">
                    <tr id="first" >
                        <td>
                            <input class="input" id="_first" type="text" name="first" placeholder="Fisrtname" 
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
                            <input class="input" id="_last" type="text" name="last" placeholder="Lastname" 
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
                            <input class="input" id="_email" type="text" name="email" placeholder="E-mail" 
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
                            <input class="input" id="_uid" type="text"  name="uid" placeholder="Username" 
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
                            <input class="input" id="_pwd" type="password" name="pwd" placeholder="Password" 
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
                            <button id="signup_but" type="submit" name="submit">S'inscrire</button>
                        </td>
                    </tr>
                </table>

    </section>
    <script src="../js/signup.js"></script>

<?PHP
    include_once 'footer.php';
?>
    </body>
</html>