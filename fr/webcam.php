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
	<h1>
		Montage photo
	</h1>
	<p>
		1. Choisissez votre image.</br>
		2. Cliquez sur le bouton Prendre une Photo.
	</p>
		<div class="flex-items">
			<label class="container">
				<img id="glasses" alt="badass glasses" src="../overlay/glasses.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_glasses" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="chapka" alt="Russian chapka" src="../overlay/chapka.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_chapka" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="chain" alt="gold chain" src="../overlay/chain.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_chain" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="canard" alt="canard sm" src="../overlay/canard.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_canard" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="couronne" alt="Queens crown" src="../overlay/couronne.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_couronne" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
			<label class="container">
				<img id="suit" alt="casual suit" src="../overlay/suit.png" style="width: 70px; height: auto"></img>
  				<input type="checkbox" id="OK_suit" onchange="put_filter(this)">
  				<span class="checkmark"></span>
			</label>
	  	</div>
	  	<div class="camera" id="camera">
	    	<video id="video">Video stream not available.</video>
			<canvas id="canvas_vid" class="canvas_vid"></canvas>
			<form id="take_picture">
				<input id="startbutton" type="submit" value="Prendre une photo">
			</form>
		</div>

  	<canvas id="canvas"></canvas>
  	<div class="flex-container">
		<div class="output">
    		<img id="photo" alt="The screen capture will appear in this box.">
  		</div>
	</div>
</section>
<!-- <script>
	function put_filter(checkbox) {
		var id = checkbox.id.split('_');
		id = id[1];
		var canvas_check = document.getElementById('canvas_'+id);
		var video = document.getElementById('video');
		if (!canvas_check) {
			var newCanvas = document.createElement("canvas");
			newCanvas.setAttribute("id", 'canvas_'+id);
			newCanvas.setAttribute("class", 'canvas_vid');
			video.after(newCanvas);
			var context = newCanvas.getContext('2d');
		}
		else
		{
			var newCanvas = canvas_check;
			var context = newCanvas.getContext('2d');
		}
		if (checkbox.checked === true){
			var img = new Image();
			img.src = '../overlay/'+id+'.png';
			console.log(img.src);
			if (id === "glasses")
				context.drawImage(img, 125, 100, 70, 15);
			else if (id === "chapka" || id === "couronne")
				context.drawImage(img, 110, 30, 100, 60);
			else if (id === "chain")
				context.drawImage(img, 12, 15, 90, 50);
			else if (id === "canard")
				context.drawImage(img, 0, 180, 60, 60);
			else if (id === "suit")
				context.drawImage(img, 40, 160, 250, 80);
		}
		else
		{
			context.clearRect(0, 0, newCanvas.width, newCanvas.height);
		}
	}
</script> -->
<script>
	var index = 0;
	function put_filter(checkbox) {
		var id = checkbox.id.split('_');
		id = id[1];
		var filtre_check = document.getElementById('filtre_'+id);
		var form = document.getElementById('take_picture');
		var camera = document.getElementById('camera');
		if (!filtre_check) {
			var filtre = new Image();
			filtre.src = '../overlay/'+id+'.png';
			filtre.setAttribute("id", 'filtre_'+id);
			index++;
			filtre.classList.add('filtre', 'index_'+index);
			form.before(filtre);
		}
		else
		{
			camera.removeChild(filtre_check);
		}
		dnd(id, camera);
	}
</script>
<script>
	function dnd(id, camera){
		var flag = false,
			filtre = document.getElementById('filtre_'+id);
			filtreW = filtre.clientWidth,
			filtreH = filtre.clientHeight
			cameraL = camera.offsetLeft,
			cameraT = camera.offsetTop;
		console.log("W = "+filtreW, "H = "+filtreH);
		console.log("camL = "+cameraL, "camT = "+cameraT);

		camera.addEventListener('mousemove', function(e){
			console.log('je passe la');
			e = e || window.event;
			if (!flag)
				return;
			var x = e.clientX,
				y = e.clientY;
			filtre.style.left = x - cameraL - filtreW/2 + 'px';
			filtre.style.top = y - cameraT - filtreH/2 + 'px';
			console.log("L = "+filtre.style.left, "T = "+filtre.style.top, "x = "+x, "y = "+y);
			filtre.style.cursor = 'move';
		});
		filtre.addEventListener('mousedown', function(e){
			console.log('je passe ici');
			flag = true;
		});
		filtre.addEventListener('mouseup', function(e){
			console.log('je passe par ici aussi');
			flag = false;
			if (filtre){
			filtre.style.cursor = 'default';
			}
			var x = e.clientX,
				y = e.clientY,
				cameraW = camera.clientWidth - filtreW/2,
				cameraH = camera.clientHeight - filtreH/2,
				cameraR = cameraL + cameraW,
				cameraB = cameraT + cameraH;
			console.log("filtre id  = "+filtre.id);
			console.log("x = "+x, "y = "+y, "camL = "+cameraL, "camT = "+cameraT, "camW = "+cameraW, "camH = "+cameraH, "camR = "+cameraR, "camB = "+cameraB);
			if (x >= cameraL && x <= cameraR && y >= cameraT && y <= cameraB){
				filtre.style.left = x  - cameraL - filtreW/2 +  'px';
				filtre.style.top = y - cameraT - filtreH/2 + 'px';
				console.log("filtreL = "+filtre.style.left, "filtreT = "+filtre.style.top);
			}
			else{
				filtre.style.left = '10%';
				filtre.style.top = '10%';
			}
		});
	}
</script>
<?PHP
	}
	else
	{
		$_SESSION['erreur']['connect'] = "Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté";
		header("Location: index.php?connect=error");
		exit();
	}
	include_once 'footer.php';
?>
</body>
</html>
