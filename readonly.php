<?PHP

function modif($modif)
{
    echo '
<td>
    <input style="width: 100%;
                margin-left: 10px;
                margin-right: 10px;" 
            id="_'.$modif.'" type="';
                        if($modif == "pwd")
                            echo "password";
                        else
                            echo "text";
    echo '" name="'.$modif.'" 
            value="';
                        if(isset($_SESSION["u_".$modif]))
                            echo $_SESSION["u_".$modif];
    echo '" readonly> 
</td>';
    if ($modif != "first" && $modif != "last")
    {
        echo '
<td>
    <button style="margin-top: 0px;
                    margin-right: 0px;
                    width: 84px;
                    border-left-width: 2px;
                    padding-bottom: 1px;
                    margin-left: 10%;" 
            type="submit" name="reset" value="'.$modif.'">Modifier</button>
</td>';
    }
}
?>