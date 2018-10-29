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
		<div class="flex-items">
			<label class="container">
				<img id="glasses" alt="badass glasses" src="overlay/glasses.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKglasses" checked="checked">
  			<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="chapka" alt="Russian chapka" src="overlay/chapka.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKchapka">
  			<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="chain" alt="gold chain" src="overlay/chain.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKchain">
  			<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="canard" alt="canard sm" src="overlay/canard.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKcanard">
  			<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="couronne" alt="Queens crown" src="overlay/couronne.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKcouronne">
  			<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="suit" alt="casual suit" src="overlay/suit.png" style="width: 70px; height: auto"></img>
  			<input type="checkbox" id="OKsuit">
  			<span class="checkmark"></span>
			</label>
	  </div>
	  <div class="camera">
	    <video id="video">Video stream not available.</video>
			<form>
			<input id="startbutton" type="submit" value="Prendre une photo">
			</form>
		</div>

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
