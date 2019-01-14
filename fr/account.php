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
                <tr id="first" >
                    <td align="right">Prénom :</td>
                    <td>
                        <input id="_first" type="text" name="first" value="<?php if(isset($_SESSION["u_first"])) echo $_SESSION["u_first"]; ?>" readonly> 
                    </td>
                </tr>
                <tr id="last" >
                    <td align="right">Nom :</td>
                    <td>
                        <input id="_last" type="text" name="last" value="<?php if(isset($_SESSION["u_last"])) echo $_SESSION["u_last"]; ?>" readonly> 
                    </td>
                </tr>
                <tr id="email">
                    <td align="right">E-mail :</td>
                    <td id="input_email">
                        <input id="_email" type="text" name="email" value="<?php if(isset($_SESSION["u_email"])) echo $_SESSION["u_email"]; ?>" readonly> 
                    </td>
                    <td id="button_email">
                        <button class="modifier" type="submit" name="update" value="email">Modifier</button>
                    </td>
                </tr>
                <tr id="uid">
                    <td align="right">Nom d'utilisateur :</td>
                    <td id="input_uid">
                        <input id="_uid" type="text" name="uid" value="<?php if(isset($_SESSION["u_uid"])) echo $_SESSION["u_uid"]; ?>" readonly> 
                    </td>
                    <td id="button_uid">
                        <button class="modifier" type="submit" name="update" value="uid">Modifier</button>
                    </td>
                </tr>
                <tr id="pwd">
                    <td align="right" id="td_pwd">Mot de passe :</td>
                    <td id="input_pwd">
                        <input id="_pwd" type="password" name="pwd" value="<?php if(isset($_SESSION["u_pwd"])) echo $_SESSION["u_pwd"]; ?>" readonly> 
                    </td>
                    <td id="button_pwd">
                        <button class="modifier" type="submit" name="update" value="pwd">Modifier</button>
                    </td>
                </tr>
            </table>
            </form>
    </section>
    <script src="../js/account.js"></script>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>