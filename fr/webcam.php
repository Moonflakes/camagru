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
				<label for="file" class="label-file">Choisir une image :</label>
				<input type="file" id="myFile" class="upl_file">
				<input type="text" placeholder="Ajouter une description" name="descr" id="descr">
				<input class="regist" type="submit" value="Enregistrer" name="submit">
			</div>
<?php
    		include_once 'user_galery.php';
?>
		</div>
	</div>
</section>
<script>

function trashPict(xhr) {
    //var photo = document.getElementById('photo');
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var button2 = document.getElementById('button2'),
        register = document.getElementById('register');
      console.log(button2);
      if (xhr.status == 200) {
        resultat = JSON.parse(xhr.responseText);
        var pict = document.getElementById('pict_'+resultat['id']);
        var grid = document.getElementById('grid');

        grid.removeChild(pict);
        console.log(resultat);
      }
      else {
        alert('Un problème est survenu avec la requête.');
      }
    }
  }

  function sendTrash(xhr, url, id, action) {
    xhr.onreadystatechange = function() {
      trashPict(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.send("id="+id+"&action="+action);
  }

  function makeRequestTrash(url, id, action) {
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
      console.log("il y a un XMLHTTP");

    }

    if (!xhr) {
      alert('Abandon :( Impossible de créer une instance XMLHTTP');
      return false;
    }
    sendTrash(xhr, url, id, action);
  }

			function registerPict(xhr) {
				if (xhr.readyState == XMLHttpRequest.DONE) {
					if (xhr.status == 200) {
						resultat = JSON.parse(xhr.responseText);
						//console.log(resultat['path']);
						var load = "<div class='action'><button type='submit' class='img_action' id='load_"+resultat['id']+"' name='load' value='"+resultat['id']+"'><img id='img_load_"+resultat['id']+"' src='../img_site/icones/icons8-télécharger-100.png' alt='load' title='Télécharger'></button><br/>",
							trash = "<button type='submit' class='img_action' id='trash_"+resultat['id']+"' name='trash' value='"+resultat['id']+"'><img id='img_trash_"+resultat['id']+"' src='../img_site/icones/trash.png' alt='trash' title='Supprimer'></button>",
							share = "<button type='submit' class='img_action' id='share_"+resultat['id']+"' name='share' value='"+resultat['id']+"'><img id='img_share_"+resultat['id']+"' src='../img_site/icones/icons8-partager-500 (1).png' alt='share' title='Partager'></button></div>";
						var new_pict = "<div class='item_photo' id='pict_"+resultat['id']+"'><div class='content_item'><figure><img class='my_photo' src='"+resultat['path'].replace(/ /g, '+')+"' alt='photo'><figcaption><small>"+resultat['descr']+"</small></figcaption>"+load+trash+share+"</figure></div></div>";

						//console.log(new_pict);
						var grid = document.getElementById('grid'); 
						grid.insertAdjacentHTML('afterbegin', new_pict);

						//addEnventListener click pour les boutons ajoutés
						var trash_img = document.getElementById('trash_'+resultat['id']);
						trash_img.addEventListener('click', function(ev){
							ev.preventDefault();
							if (confirm("Voulez-vous vraiment supprimer cette image ?"))
							{
								var id = this.id;   // Getting Button id
								var split_id = id.split("_");
								var id = split_id[1];
								var action_img = split_id[0];
								if (action_img === "trash")
									makeRequestTrash('../include/trash_img.php', id, action_img);
								//console.log(split_id);
							}
						}, false);
					}
					else {
						alert('Un problème est survenu avec la requête.');
					}
				}
			}

			function sendReqregister(xhr, url, cam_pict, descr) {
				xhr.onreadystatechange = function() {
					console.log(xhr);
					registerPict(xhr); 
				};
				xhr.open('POST', url, true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				
				var submit = document.getElementById("register").value;
				xhr.send("submit="+submit+"&pict="+cam_pict+"&descr="+descr);
			}

			function mergePict(xhr) {
				//var photo = document.getElementById('photo');
				if (xhr.readyState == XMLHttpRequest.DONE) {
					var button2 = document.getElementById('button2'),
						register = document.getElementById('register');
					console.log(button2);
					if (xhr.status == 200) {
						resultat = JSON.parse(xhr.responseText);
						console.log(resultat);
						photo.setAttribute('src', resultat['data']); // afficher l'image mergée
						//console.log(xhr.responseText);

						// prendre => reprendre
						startbutton.setAttribute("value", 'Reprendre');
						if (!register)
						{
							//creer input description
							descr = document.createElement("input");
							descr.setAttribute("id", 'descr');
							descr.setAttribute("type", 'text');
							descr.setAttribute("name", 'descr');
							descr.setAttribute("placeholder", 'Ajouter une description');
							button2.appendChild(descr);
							// creer bouton enregistrer
							register = document.createElement("input");
							register.setAttribute("id", 'register');
							register.setAttribute("type", 'submit');
							register.setAttribute("name", 'submit');
							register.setAttribute("value", 'Enregistrer');
							button2.appendChild(register);
							register.addEventListener('click', function(ev){
								var descr_val = document.getElementById("descr").value,
									path = resultat['data'];
								if (descr_val) {
									console.log(descr_val);
									makeRequest('../include/register_photo.php', path, descr_val);
								}
								ev.preventDefault();
							}, false);
						}

					}
					else {
						alert('Un problème est survenu avec la requête.');
					}
				}
			}

			function sendReqmerge(xhr, url, cam_pict) {
				xhr.onreadystatechange = function() {
					mergePict(xhr); 
				};
				xhr.open('POST', url, true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				
				var filtre_name = ["canard", "chain", "chapka", "couronne", "glasses", "suit"];
				var filtre_infos = {};

				filtre_name.forEach(function(element) {
					checkFiltre = document.getElementById("OK_"+element);
					if (checkFiltre.checked == true)
					{
					var filtre = document.getElementById('filtre_'+element);
					var index = filtre.classList[1].split('_')[1];
					filtre_infos[`${index}`] = element;
					}
				});
				filter = Object.values(filtre_infos);
				var height = [];
				var width = [];
				var top = [];
				var left = [];
				var src = [];
				filter.forEach(function(element) {
					var img = new Image();
					img.src = '../overlay/'+element+'.png';
					filtre = document.getElementById('filtre_'+element);
					h = filtre.height;
					w = filtre.width;
					t = filtre.offsetTop;
					l = filtre.offsetLeft;
					height.push(h);
					width.push(w);
					top.push(t);
					left.push(l);
					src.push(img.src);
				});
				var submit = document.getElementById("startbutton").value;
				xhr.send("submit="+submit+"&top="+JSON.stringify(top)+"&height="+
				JSON.stringify(height)+"&width="+JSON.stringify(width)+"&left="+
				JSON.stringify(left)+"&src="+JSON.stringify(src)+"&camera="+cam_pict);
			}

			function makeRequest(url, cam_pict, action) {
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
					console.log("il y a un XMLHTTP");

				}

				if (!xhr) {
					alert('Abandon :( Impossible de créer une instance XMLHTTP');
					return false;
				}
				if (action)
					sendReqregister(xhr, url, cam_pict, action);
				else
					sendReqmerge(xhr, url, cam_pict);
			}

			function takepicture(){
				console.log("take picture");
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
					makeRequest('../include/take_photo.php', data, 0);
				}
				else {
					clearphoto();
				}
			}
    </script>
<script>

	function verif_check(){
		var filtre_name = ["canard", "chain", "chapka", "couronne", "glasses", "suit"];
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
		var form = document.getElementById('button1');
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
