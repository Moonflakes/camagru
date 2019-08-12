<?PHP
    include_once 'header.php';
    include_once 'message.php';
?>
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <section class="signup">
        <div class="main-wrapper">
            <h2 class="h2sign" >Réinitialisation du mot de passe</h2>
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
                            <input id="_pwd" type="password" name="pwd" placeholder="New password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit" id="resetpwd"
                            value="<?php 
                                if(isset($_GET['key']))
                                    echo $_GET['key']; ?>">Réinitialiser</button>
                        </td>
                    </tr>
                </table>
        </div>
    </section>
    <script src="../js/resetpwd.js"></script>
<?PHP
    include_once 'footer.php';
?>