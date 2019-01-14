<?PHP

function modif($modif)
{
    echo '
<td>
    <input id="_'.$modif.'" type="';
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
    <button class="modifier"
            type="submit" name="update" value="'.$modif.'">Modifier</button>
</td>';
    }
}
?>