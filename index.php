<?PHP
    include_once 'header.php';
?>
     <section class="main-container">
        <div class="main-wrapper">
    <script type="text/javascript">
        var erreur = <?PHP echo json_encode($_SESSION['erreur']); ?>;
            $(document).ready(function () 
            {
                if (erreur)
                {
                    $.each(erreur,function(index,element)
                    {
                        $("#"+index).after("<tr><td><font color='red'>"+ element +"</font></td></tr>");
                        $("#_"+index).css('backgroundColor', 'rgba(248, 207, 72, 0.3)');
                    })
                }
            })
    </script>
<?PHP
    if (isset($_SESSION['erreur']))
    {
        //supprimer le message d'erreur
        foreach ($_SESSION['erreur'] as $key => $value)
            echo '<font color="red">'.$value.'</font></br>';
        unset($_SESSION['erreur']);
    }
    else if (isset($_SESSION['u_id']))
    {
        echo "Bienvenu ".strtoupper($_SESSION['u_first'])." !";
    }
?>
            </div>
        </section>
<?PHP
    include_once 'footer.php';
?>