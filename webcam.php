<html>
<head>
	<title>Camagru: Montage photo</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" href="webcam.css" type="text/css" media="all">
	<script src="webcam.js">
	</script>
</head>
<body>
<?PHP
	include_once 'header.php';
?>
<div class="contentarea">
	<h1>
		Montage photo
	</h1>
	<p>
		1. Choisissez votre image.</br>
		2. Cliquez sur le bouton Prendre une Photo.
	</p>
	<form>
		<div class="flex-items">
			<input type="radio" name="ooverlay" value="glasses" checked>
			<img id="glasses" alt="badass glasses" src="glasses.png" style="width: 70px; height: auto"></img>
			<input type="radio" name="ooverlay" value="chapka">
			<img id="glasses" alt="badass glasses" src="chapka.png" style="width: 70px; height: auto"></img>
			<input type="radio" name="ooverlay" value="glasses">
			<img id="glasses" alt="badass glasses" src="glasses.png" style="width: 70px; height: auto"></img>
	  </div>
	  <div class="camera">
	    <video id="video">Video stream not available.</video>
			<input id="startbutton" type="submit" value="Prendre une photo">
	  </div>
	</form>
  <canvas id="canvas"></canvas>
  <div class="flex-container">
		<div class="output">
    	<img id="photo" alt="The screen capture will appear in this box.">
  	</div>
	</div>
</div>
<?PHP
	include_once 'footer.php';
?>
</body>
</html>
