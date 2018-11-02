<?PHP

if (isset($_GET['modif']) && ($_GET['modif'] == "pwd" || $_GET['modif'] == 'oldpwd' || $_GET['modif'] == 'newpwd'))
{
?>
    <tr id="oldpwd">
        <td align="right">Ancien mot de passe :</td>
        <td>
            <input style="width: 100%;
                        margin-left: 10px;
                        margin-right: 10px;" 
                    id="_<?php echo 'oldpwd'?>" type="password" name="<?php echo 'oldpwd'?>"
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
            <input style="width: 100%;
                        margin-left: 10px;
                        margin-right: 10px;" 
                    id="_<?php echo 'newpwd'?>" type="password" name="<?php echo 'newpwd'?>"
                    value="<?php 
                                if(isset($_SESSION['newpwd']))
                                {
                                    echo $_SESSION['newpwd'];
                                    $_SESSION['newpwd'] = "";
                                } ?>">
        </td>
        <td>
            <button style="margin-top: 0px;
                            margin-right: 0px;
                            width: 84px;
                            border-left-width: 2px;
                            padding-bottom: 1px;
                            margin-left: 10%;
                            background-color: rgb(225, 255, 245);
                            color: rgb(48, 133, 104);" 
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

