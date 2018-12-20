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
  var startbutton = null;

  var action = null;

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
      console.log("il y a un XMLHTTP");

    }

    if (!xhr) {
      alert('Abandon :( Impossible de créer une instance XMLHTTP');
      return false;
    }
    sendTrash(xhr, url, id, action);
  }

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');
    action = document.getElementsByClassName('img_action');

    //console.log(action);
    // ajouter fonction a l'action
    Array.from(action).forEach(function(element) {
      element.addEventListener('click', function(ev){
        ev.preventDefault();
        var id = this.id;   // Getting Button id
          var split_id = id.split("_");
          var id = split_id[1];
          var action_img = split_id[0];
          if (action_img === "trash")
            makeRequest('../include/trash_img.php', id, action_img);
          //console.log(split_id);
      }, false);
    });
    

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
	/*	.catch(function(err) {
		  console.log(err.name + ": " + err.message);
		});
  */

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

  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.
  
  //merge picture en js
/*  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      var filtre_name = ["canard", "chain", "chapka", "couronne", "glasses"];
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
      //console.log(filtre_infos);
      filter = Object.values(filtre_infos);
      filter.forEach(function(element) {
        var img = new Image();
        img.src = '../overlay/'+element+'.png';
        filtre = document.getElementById('filtre_'+element);
        h = filtre.height;
        w = filtre.width;
        t = filtre.offsetTop;
        l = filtre.offsetLeft;
        console.info(filtre.offsetTop);
        context.drawImage(img, l, t, w, h);
      });
      var data = canvas.toDataURL('image/png');
      console.log(data);
      photo.setAttribute('src', data);
    } else {
      clearphoto();
    }
  }*/

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);

})();

