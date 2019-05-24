<html>
<head>
	<title>Camagru: Montage photo</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" href="../css/webcam.css" type="text/css" media="all">
	<script src="../js/webcam.js">
	</script>
</head>
<body>
<?PHP
	include_once 'header.php';
	include_once '../config/setup.php';
	include_once '../include/check_user.php';

	if (check_user_is_connect($connexion))
	{
?>
<section class="contentarea">
	<div class="montage_page">
		<div class="montage">
			<div class="explication">
				<h1>
					Montage photo
				</h1>
			</div>
			<div class="flex-items" id="blabla">
				<form id="take_picture" method="POST">
					<label class="container">
						<input type="checkbox" class="filter" id="OK_glasses" name="glasses">
						<img id="glasses" alt="badass glasses" src="../overlay/glasses.png"/>
					</label>
					<label class="container">
						<input type="checkbox" class="filter" id="OK_chapka" name="chapka">
						<img id="chapka" alt="Russian chapka" src="../overlay/chapka.png"/>
					</label>
					<label class="container">
						<input type="checkbox" class="filter" id="OK_chain" name="chain">
						<img id="chain" alt="gold chain" src="../overlay/chain.png"/>
					</label>
					<label class="container">
						<input type="checkbox" class="filter" id="OK_canard" name="canard">
						<img id="canard" alt="canard sm" src="../overlay/canard.png"/>
					</label>
					<label class="container">
						<input type="checkbox" class="filter" id="OK_couronne" name="couronne">
						<img id="couronne" alt="Queens crown" src="../overlay/couronne.png"/>
					</label>
					<label class="container">
						<input type="checkbox" class="filter" id="OK_suit" name="suit">
						<img id="suit" alt="casual suit" src="../overlay/suit.png"/>
					</label>
				</form>
				<div class="take_photo">
					<div class="camera" id="camera">
						<video id="video">Video stream not available.</video>
					</div>
					<div id="button1"></div>
					<canvas id="canvas"></canvas>
					<div class="flex-container">
						<div class="output">
							<img id="photo" alt="The screen capture will appear in this box.">
						</div>
					</div>
					<div id="button2"></div>
				</div>
			</div>
		</div>
	<div class="galery_pict">
			<h1>Ma galerie</h1>
			<div class="upload">
				<label for="myFile" class="label-file">Choisir une image</label>
				<input type="file" id="myFile" class="upl_file" accept=".jpg, .jpeg, .png"><br/>
				<div id="preview">
					<p>Aucun fichier sélectionné pour le moment</p>
				</div>
			</div>
<?php
    		include_once 'user_galery.php';
?>
		</div>
	</div>
</section>
<?PHP
	}
	else
	{
		$_SESSION['erreur']['connect'] = "Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté";
		header("Location: index.php?login=ask");
		exit();
	}
	include_once 'footer.php';
?>
</body>
</html>
