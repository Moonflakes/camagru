<html>
    <head>
        <title>Camagru : Supprimer</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/delete_account.css" type="text/css">
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
    if (!isset($_SESSION['u_id'])) {
        $_SESSION['erreur']['connect'] = "Pour accéder à cette page vous devez être connecté !";
        header('Location: ../fr/home.php?login=ask');
    }
?>
    <section class="account">
        <h2 class="h2sign" >Suppression du compte</h2>
        <p align="center">Renseignez toutes les informations ci-dessous afin que nous puissions procéder à la suppression de vous données en toute sécurité.</p>
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
                        <input id="_email" type="text" name="email"> 
                    </td>
                </tr>
                <tr id="uid">
                    <td align="right">Nom d'utilisateur :</td>
                    <td id="input_uid">
                        <input id="_uid" type="text" name="uid"> 
                    </td>
                </tr>
                <tr id="pwd">
                    <td align="right" id="td_pwd">Mot de passe :</td>
                    <td id="input_pwd">
                        <input id="_pwd" type="password" name="pwd"> 
                    </td>
                </tr>
            </table>
            </form>
            <table style="width: 50%;" class="account-form">
                <tr id="pwd">
                    <td style="width: 40%;"></td>
                    <td id="delete">
                        <button class="delete" type="submit" name="delete" value="delete">Supprimer</button>
                    </td>
                </tr>
            </table>
    </section>
    <script src="../js/delete_account.js"></script>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>