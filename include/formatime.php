<?php
function formatime($dif_time)
{
    if ($dif_time->y)
        $time = $dif_time->y." ans";
    else if ($dif_time->m)
        $time = $dif_time->m." mois";
    else if ($dif_time->d)
        $time = $dif_time->d." j";
    else if ($dif_time->h)
        $time = $dif_time->h." h";
    else if ($dif_time->i)
        $time = $dif_time->i." min";
    else if ($dif_time->s)
        $time = $dif_time->s." sec";
    
    return ($time);
}
?>