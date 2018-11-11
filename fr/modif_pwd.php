<?PHP

if (isset($_GET['modif']) && ($_GET['modif'] == "pwd" || $_GET['modif'] == 'oldpwd' || $_GET['modif'] == 'newpwd'))
{
?>
    <tr id="oldpwd">
        <td align="right">Ancien mot de passe :</td>
        <td>
            <input id="_<?php echo 'oldpwd'?>" type="password" name="<?php echo 'oldpwd'?>"
                    value="<?php 
                                if(isset($_SESSION['oldpwd']))
                                {
                                    echo $_SESSION['oldpwd'];
                                    $_SESSION['oldpwd'] = "";
                                } ?>">
        </td>
        <td></td>
    </tr>
    <tr id="newpwd">
        <td align="right">Nouveau mot de passe :</td>
        <td>
            <input id="_<?php echo 'newpwd'?>" type="password" name="<?php echo 'newpwd'?>"
                    value="<?php 
                                if(isset($_SESSION['newpwd']))
                                {
                                    echo $_SESSION['newpwd'];
                                    $_SESSION['newpwd'] = "";
                                } ?>">
        </td>
        <td>
            <button class="valider" 
                    type="submit" name="update" value="pwd">Valider</button>
        </td>
    </tr>
<?php
}
else
{
?>
    <tr id="pwd">
        <td align="right">Mot de passe :</td>
        <?php
            if (isset($_GET['modif']) && $_GET['modif'] == "pwd")
            {
                include_once 'modif.php';
            }
            else
            {
                include_once 'readonly.php';
                modif("pwd");
            }
        ?>
    </tr>
<?php
}
?>

