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
		<form id="take_picture" method="POST">
			<label class="container">
  				<input type="checkbox" id="OK_glasses" onchange="put_filter(this)" name="glasses">
				  <img id="glasses" alt="badass glasses" src="../overlay/glasses.png"/>
			</label>
			<label class="container">
  				<input type="checkbox" id="OK_chapka" onchange="put_filter(this)" name="chapka">
  				<img id="chapka" alt="Russian chapka" src="../overlay/chapka.png"/>
			</label>
			<label class="container">
  				<input type="checkbox" id="OK_chain" onchange="put_filter(this)" name="chain">
  				<img id="chain" alt="gold chain" src="../overlay/chain.png"/>
			</label>
			<label class="container">
  				<input type="checkbox" id="OK_canard" onchange="put_filter(this)" name="canard">
  				<img id="canard" alt="canard sm" src="../overlay/canard.png"/>
			</label>
			<label class="container">
  				<input type="checkbox" id="OK_couronne" onchange="put_filter(this)" name="couronne">
  				<img id="couronne" alt="Queens crown" src="../overlay/couronne.png"/>
			</label>
			<label class="container">
  				<input type="checkbox" id="OK_suit" onchange="put_filter(this)" name="suit">
  				<img id="suit" alt="casual suit" src="../overlay/suit.png"/>
			</label>
		</form>
		<div class="take_photo">
			<div class="camera" id="camera">
				<video id="video">Video stream not available.</video>
			</div>
			<canvas id="canvas"></canvas>
			<div class="flex-container">
				<div class="output">
					<img id="photo" alt="The screen capture will appear in this box.">
				</div>
			</div>
		</div>
	</div>
	  	
</section>
<script>
			function takepicture(){
				var canvas = document.getElementById('canvas');
				var video = document.getElementById('video');
				var context = canvas.getContext('2d');
				var width = 320;
				var height = 240;

				if (width && height) {
					canvas.width = width;
					canvas.height = height;
					context.drawImage(video, 0, 0, width, height);
					var data = canvas.toDataURL('image/png');
					console.log(data);
					merge_picture(data);
					//photo.setAttribute('src', data);
				}
				else {
					clearphoto();
				}
			}

			function makeRequest(url) {
				var xhr = null;
	
				if (window.XMLHttpRequest || window.ActiveXObject) {
					if (window.ActiveXObject) {
						try {
							xhr = new ActiveXObject("Msxml2.XMLHTTP");
						} catch(e) {
							xhr = new ActiveXObject("Microsoft.XMLHTTP");
						}
					} else {
						xhr = new XMLHttpRequest(); 
					}
					console.log("jaja");

				}

				if (!xhr) {
					alert('Abandon :( Impossible de créer une instance XMLHTTP');
					return false;
				}
				xhr.onreadystatechange = function() { alertContents(xhr); };
				xhr.open('POST', url, true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("submit=truc&camera=bidule");

			}

			function alertContents(xhr) {

				if (xhr.readyState == XMLHttpRequest.DONE) {
					if (xhr.status == 200) {
						console.log(xhr.responseText);
					} else {
						alert('Un problème est survenu avec la requête.');
					}
				}

			}

		function merge_picture(cam_pict){
				

				console.log ("aaaaaaaaaaaaaah");
				makeRequest('../include/take_photo.php');
				/*$.post(
                    '../include/take_photo.php', 
                    {
						camera : cam_pict,
						canard : $("#OK_canard").val(),
						glasses : $("#OK_glasses").val(),
						chapka : $("#OK_chapka").val(),
						chain : $("#OK_chain").val(),
						couronne : $("#OK_couronne").val(),
						suit : $("#OK_suit").val(),
                        submit : $("#startbutton").val()
                    },
        
                    function(data){
						console.log(data);
                    },
                    'json'
                );
                $('#comment').val('');
                $('#comment').css("height", "50");*/
			}
    </script>
<script>

	function verif_check(){
		var filtre_name = ["canard", "chain", "chapka", "couronne", "glasses"];
		var a = 0;
		filtre_name.forEach(function(element) {
			checkFiltre = document.getElementById("OK_"+element);
			if (checkFiltre.checked == true)
			{
				a = 1;
				make_button(a);
			}
		})
		return remove_button(a);
	}
	function make_button(a){
		var startbutton = document.getElementById('startbutton');
		var form = document.getElementById('take_picture');
    	if (!startbutton && a === 1)
    	{
			console.log("je passe ici");
			startbutton = document.createElement("input");
			console.log (startbutton);
			startbutton.setAttribute("id", 'startbutton');
			startbutton.setAttribute("type", 'submit');
			startbutton.setAttribute("name", 'submit');
			startbutton.setAttribute("value", 'Prendre une photo');
			form.appendChild(startbutton);
		}
		startbutton.addEventListener('click', function(ev){
			takepicture();
			ev.preventDefault();
			console.log(startbutton);
			}, false);
	}

	function remove_button(a){
		var startbutton = document.getElementById('startbutton');
		var form = document.getElementById('take_picture');
		if (startbutton && a === 0)
    	{
			console.log("je remove");
			form.removeChild(startbutton);
		}
  }

	var index = 0;
	function put_filter(checkbox) {
		verif_check();
		var id = checkbox.id.split('_');
		id = id[1];
		var filtre_check = document.getElementById('filtre_'+id);
		var camera = document.getElementById('camera');
		if (!filtre_check) {
			var filtre = new Image();
			filtre.src = '../overlay/'+id+'.png';
			filtre.setAttribute("id", 'filtre_'+id);
			index++;
			filtre.classList.add('filtre', 'index_'+index);
			camera.appendChild(filtre);
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
			var x = e.pageX,
				y = e.pageY;
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
			var x = e.pageX, // ou clientX
				y = e.pageY,
				limitL = cameraL + filtreW/2,
				limitT = cameraT + filtreH/2,
				cameraW = camera.clientWidth - filtreW/2,
				cameraH = camera.clientHeight - filtreH/2,
				limitR = cameraL + cameraW,
				limitB = cameraT + cameraH;
			//console.log("filtre id  = "+filtre.id);
			console.log("x = "+x, "y = "+y, "limitL = "+limitL, "limitT = "+limitT, "limitR = "+limitR, "limitB = "+limitB);
			if (x >= limitL && x <= limitR && y >= limitT && y <= limitB){
				//console.log("est-ce que je passe la ?");
				filtre.style.left = x - cameraL - filtreW/2 +  'px';
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
