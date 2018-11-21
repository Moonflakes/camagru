<html>
    <head>
        <title>Camagru</title>
        <meta charset='utf-8'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        body
        {
            font-family: monospace;
        }
    </style>
    <body>     
<?php
    include_once 'header.php';
?>
    <div class="login-div">
<?php
    if (isset($_GET['login']) && $_GET['login'] != "success")
    {
        include_once 'login2.php';
    }
?>
    </div>
<?php
    include_once 'message.php';
    include_once 'galery2.php';
?>
    <script>
	$('a.login').click(function() {
	  loadContent( $(this).attr('href') );
	  return false;
	});
	
	function loadContent(page){
		$.ajax({
		  url: page,
		  success: function(data) {
			$('.login-div').html(data);
		  }
		});
	}
	</script>
    </body>
</html>