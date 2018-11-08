<td>
    <input id="_<?php if (isset($_GET['modif'])) echo $_GET['modif'];?>" type="text" name="<?php if (isset($_GET['modif'])) echo $_GET['modif'];?>"
            value="<?php 
                        if(isset($_SESSION['param']))
                        {
                            echo $_SESSION['param'];
                            $_SESSION['param'] = "";
                        } ?>">
</td>
<td>
    <button  class="valider"
            type="submit" name="update" value="<?php if (isset($_GET['modif'])) echo $_GET['modif'];?>">Valider</button>
</td>