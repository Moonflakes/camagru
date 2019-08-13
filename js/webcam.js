(function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 320;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  var choose_file = null;
  var preview = null;
  var filter = null;

  var action = null;


  function trashPict(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var button2 = document.getElementById('button2'),
        register = document.getElementById('register');
      // console.log(button2);
      if (xhr.status == 200) {
        resultat = JSON.parse(xhr.responseText);
        var pict = document.getElementById('pict_'+resultat['id']);
        var grid = document.getElementById('grid');

        grid.removeChild(pict);
        // console.log(resultat);
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

  function resize_item(resultat) {
    var content_item = document.getElementById('content_'+resultat['id']),
        item = document.getElementById('pict_'+resultat['id']),
        action = document.getElementById('action_'+resultat['id']),
        h_content = content_item.clientHeight;
        item.style.height = h_content;
    var h_load = (action.clientHeight * 40/100);
    if (action.clientHeight > 190)
      h_load = 71;
    action.style.paddingTop = ((action.clientHeight - (2 * h_load)) / 2) - 7;
}


  function registerPict(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        resultat = JSON.parse(xhr.responseText);
        //console.log(resultat['path']);
        var img_load = "<img class='img_action' id='img_load_"+resultat['id']+"' src='../img_site/icones/icons8-télécharger-100.png' alt='load' title='Télécharger'>",
          img_trash = "<img id='img_trash_"+resultat['id']+"' src='../img_site/icones/trash.png' alt='trash' title='Supprimer'>",
          img_share = "<img id='img_share_"+resultat['id']+"' src='../img_site/icones/icons8-partager-500 (1).png' alt='share' title='Partager'>",
          load = "<div class='action' id='action_"+resultat['id']+"'><a href='"+resultat['path'].replace(/ /g, '+')+"' class='ref' download='img_galerie.png'>"+img_load+"</a><br/>",
          trash = "<button type='submit' class='img_action' id='trash_"+resultat['id']+"' name='trash' value='"+resultat['id']+"'>"+img_trash+"</button>",
          share = "<button type='submit' class='img_action' id='share_"+resultat['id']+"' name='share' value='"+resultat['id']+"'>"+img_share+"</button></div>",
          image = "<img class='my_photo' src='"+resultat['path'].replace(/ /g, '+')+"' alt='photo'>",
          caption = "<figcaption><small>"+resultat['descr']+"</small></figcaption>";
        var new_pict = "<div class='item_photo' id='pict_"+resultat['id']+"'><div class='content_item' id='content_"+resultat['id']+"'><figure>"+image+caption+load+trash+share+"</figure></div></div>";

        //console.log(new_pict);
        var grid = document.getElementById('grid'); 
        grid.insertAdjacentHTML('afterbegin', new_pict);
        resize_item(resultat);

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
              makeRequest('../include/trash_img.php', id, action_img);
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
      // console.log(xhr);
      registerPict(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    var submit = document.getElementById("register");
    submit = (submit) ? submit.value : document.getElementById("register_upload").value;
    xhr.send("submit="+submit+"&pict="+cam_pict+"&descr="+descr);
  }

  function mergePict(xhr) {
    //var photo = document.getElementById('photo');
    if (xhr.readyState == XMLHttpRequest.DONE) {
      var button2 = document.getElementById('button2'),
        register = document.getElementById('register');
      // console.log(button2);
      if (xhr.status == 200) {
        resultat = JSON.parse(xhr.responseText);
        // console.log(resultat);
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
              // console.log(descr_val);
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

  function makeRequest(url, id, action) {
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
      // console.log(action);

    }

    if (!xhr) {
      alert('Abandon :( Impossible de créer une instance XMLHTTP');
      return false;
    }
    if (action === "trash")
      sendTrash(xhr, url, id, action);
    else {
      if (action)
        sendReqregister(xhr, url, id, action);
      else
        sendReqmerge(xhr, url, id);
    }
  }

  function returnFileSize(number) {
    if(number < 1024) {
      return number + ' octets';
    }
    else if(number >= 1024 && number < 1048576) {
      return (number/1024).toFixed(1) + ' Ko';
    }
    else if(number >= 1048576) {
      return (number/1048576).toFixed(1) + ' Mo';
    }
  }

  function readFile(file, image) {
  
    if (file && file[0]) {
      
      var FR = new FileReader();
      
      FR.addEventListener("load", function(e) {
        image.src = e.target.result;
      }); 
      
      FR.readAsDataURL(file[0]);
    }
  }

  function deleteUploadDiv() {
    preview.innerHTML = '';
    preview.innerHTML = '<p>Votre image a bien été enregistrée</p>'
  }

  function updateImageDisplay() {
    // console.log(preview.firstChild)
    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }
  
    var curFiles = choose_file.files;
    // console.log(curFiles);
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'Aucun fichier sélectionné pour le moment';
      preview.appendChild(para);
    }
    else {
        var item_img = document.createElement('div');
        var para = document.createElement('p');
        var image = document.createElement('img');
        var descr = document.createElement('div');
        var text = document.createElement('input');
        var register_but = document.createElement('input');

        para.textContent = 'Nom du fichier ' + curFiles[0].name + ', taille du fichier ' + returnFileSize(curFiles[0].size) + '.';
        // src en base64
        readFile(curFiles, image);
        image.setAttribute('id', 'img_upload');
        // console.log(image)
        
        item_img.appendChild(para);
        item_img.appendChild(image);
        item_img.setAttribute('style', 'margin-bottom:20');
        preview.appendChild(item_img);

        text.setAttribute('type', 'text');
        text.setAttribute("id", 'descr_upload');
        text.setAttribute("type", 'text');
        text.setAttribute("name", 'descr');
        text.setAttribute("placeholder", 'Ajouter une description');
        descr.appendChild(text);

        register_but = document.createElement("input");
				register_but.setAttribute("id", 'register_upload');
				register_but.setAttribute("type", 'submit');
				register_but.setAttribute("name", 'submit');
				register_but.setAttribute("value", 'Enregistrer');
        descr.appendChild(register_but);
        preview.appendChild(descr);
				register_but.addEventListener('click', function(ev){
          var descr_val = document.getElementById("descr_upload").value,
              path = image.src;
          if (descr_val) {
              // console.log(descr_val);
              makeRequest('../include/register_photo.php', path, descr_val);
              deleteUploadDiv();
          }
            ev.preventDefault();
				}, false);
      }
  }

  function takepicture(){
    // console.log("take picture");
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

  function dnd(id, camera){
		var flag = false,
      filtre = document.getElementById('filtre_'+id);
    
      if (filtre) {
        filtreW = filtre.clientWidth,
        filtreH = filtre.clientHeight
        cameraL = camera.offsetLeft,
        cameraT = camera.offsetTop;
      // console.log("W = "+filtreW, "H = "+filtreH);
      // console.log("camL = "+cameraL, "camT = "+cameraT);

      camera.addEventListener('mousemove', function(e){
        // console.log('je passe la');
        e = e || window.event;
        if (!flag)
          return;
        var x = e.pageX,
          y = e.pageY;
        filtre.style.left = x - cameraL - filtreW/2 + 'px';
        filtre.style.top = y - cameraT - filtreH/2 + 'px';
        // console.log("L = "+filtre.style.left, "T = "+filtre.style.top, "x = "+x, "y = "+y);
        filtre.style.cursor = 'move';
      });
      filtre.addEventListener('mousedown', function(e){
        // console.log('je passe ici');
        flag = true;
      });
      filtre.addEventListener('mouseup', function(e){
        // console.log('je passe par ici aussi');
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
        // console.log("x = "+x, "y = "+y, "limitL = "+limitL, "limitT = "+limitT, "limitR = "+limitR, "limitB = "+limitB);
        if (x >= limitL && x <= limitR && y >= limitT && y <= limitB){
          //console.log("est-ce que je passe la ?");
          filtre.style.left = x - cameraL - filtreW/2 +  'px';
          filtre.style.top = y - cameraT - filtreH/2 + 'px';
          // console.log("filtreL = "+filtre.style.left, "filtreT = "+filtre.style.top);
        }
        else{
          filtre.style.left = '10%';
          filtre.style.top = '10%';
        }
    });
  }
  }
  
  function make_button(a){
		var startbutton = document.getElementById('startbutton');
		var form = document.getElementById('button1');
    	if (!startbutton && a === 1)
    	{
			// console.log("je passe ici");
			startbutton = document.createElement("input");
			// console.log (startbutton);
			startbutton.setAttribute("id", 'startbutton');
			startbutton.setAttribute("type", 'submit');
			startbutton.setAttribute("name", 'submit');
			startbutton.setAttribute("value", 'Prendre une photo');
			form.appendChild(startbutton);
		}
		startbutton.addEventListener('click', function(ev){
			takepicture();
			ev.preventDefault();
			// console.log(startbutton);
			}, false);
	}

	function remove_button(a){
		var startbutton = document.getElementById('startbutton');
		var form = document.getElementById('button1');
		if (startbutton && a === 0)
    	{
			// console.log("je remove");
			form.removeChild(startbutton);
		}
  }

  function verif_check(){
		var filtre_name = ["canard", "chain", "chapka", "couronne", "glasses", "suit"];
		var a = 0;
		filtre_name.forEach(function(element) {
			checkFiltre = document.getElementById("OK_"+element);
			if (checkFiltre.checked === true)
			{
				a = 1;
				make_button(a);
			}
		})
		remove_button(a);
	}

  var index = 0;
	function putFilter() {
    verif_check();
    // console.log(this);
		var id = this.id.split('_');
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

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    action = document.getElementsByClassName('but_act');
    choose_file = document.getElementById('myFile');
    preview = document.getElementById('preview'),
    filter = document.getElementsByClassName('filter');

    Array.from(filter).forEach(function(element) {
      element.addEventListener('change', putFilter);
    });

    // console.log(choose_file);
    // ajouter fonction a l'action
    Array.from(action).forEach(function(element) {
      element.addEventListener('click', function(ev){
        ev.preventDefault();
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");
        var id = split_id[1];
        var action_img = split_id[0];
          if (action_img === "trash" && confirm("Voulez-vous vraiment supprimer cette image ?"))
            makeRequest('../include/trash_img.php', id, action_img);
          //console.log(split_id);
      }, false);
    });

    //fonction choose file
    choose_file.addEventListener('change', updateImageDisplay);

    
    // Older browsers might not implement mediaDevices at all, so we set an empty object first
		if (navigator.mediaDevices === undefined) {
		  navigator.mediaDevices = {};
		}

		// Some browsers partially implement mediaDevices. We can't just assign an object
		// with getUserMedia as it would overwrite existing properties.
		// Here, we will just add the getUserMedia property if it's missing.
		if (navigator.mediaDevices.getUserMedia === undefined) {
		  navigator.mediaDevices.getUserMedia = function(constraints) {

		    // First get ahold of the legacy getUserMedia, if present
		    var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

		    // Some browsers just don't implement it - return a rejected promise with an error
		    // to keep a consistent interface
		    if (!getUserMedia) {
		      return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
		    }

		    // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
		    return new Promise(function(resolve, reject) {
		      getUserMedia.call(navigator, constraints, resolve, reject);
		    });
		  }
		}

		navigator.mediaDevices.getUserMedia({ audio: false, video: true })
		.then(function(stream) {
      //console.log(stream);
		  var video = document.querySelector('video');
		  // Older browsers may not have srcObject
		  if ("srcObject" in video) {
		    video.srcObject = stream;
		  } else {
		    // Avoid using this in new browsers, as it is going away.
		    video.src = window.URL.createObjectURL(stream);
		  }
		  video.onloadedmetadata = function(e) {
        video.play();
		  };
		})
		.catch(function(err) {
		  console.log(err);
		});
  

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);

        // Firefox currently has a bug where the height can't be read from
        // the video, so we will make assumptions if this happens.

        if (isNaN(height)) {
          height = width / (4/3);
        }

        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    clearphoto();
  }
  
  
  

  // Fill the photo with an indication that none has been
  // captured.

  function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "aquamarine";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);

})();

