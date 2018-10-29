<?PHP
session_start();
?>
<td>
    <input style="width: 100%;
                margin-left: 10px;
                margin-right: 10px;" 
            id="_<?php echo $_GET['modif']?>" type="text" name="<?php echo $_GET['modif']?>"
            value="<?php 
                        if(isset($_SESSION['param']))
                        {
                            echo $_SESSION['param'];
                            $_SESSION['param'] = "";
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
            type="submit" name="update" value="<?php echo $_GET['modif']?>">Valider</button>
</td>