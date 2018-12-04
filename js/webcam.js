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

  var glasses = null;
  var chapka = null;
  var canard = null;
  var couronne = null;
  var suit = null;
  var chain = null;

  var checkGlasses = null;
  var checkChain = null;
  var checkCouronne = null;
  var checkSuit = null;
  var checkCanard = null;
  var checkChapka = null;

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    canvas_vid = document.getElementById('canvas_vid');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');

    glasses = document.getElementById('glasses');
    glasses.setAttribute('crossOrigin', 'anonymous');
    chapka = document.getElementById('chapka');
    chapka.setAttribute('crossOrigin', 'anonymous');
    chain = document.getElementById('chain');
    chain.setAttribute('crossOrigin', 'anonymous');
    canard = document.getElementById('canard');
    canard.setAttribute('crossOrigin', 'anonymous');
    suit = document.getElementById('suit');
    suit.setAttribute('crossOrigin', 'anonymous');
    couronne = document.getElementById('couronne');
    couronne.setAttribute('crossOrigin', 'anonymous');

    checkGlasses = document.getElementById("OK_glasses");
    checkChain = document.getElementById("OK_chain");
    checkCouronne = document.getElementById("OK_couronne");
    checkSuit = document.getElementById("OK_suit");
    checkCanard = document.getElementById("OK_canard");
    checkChapka = document.getElementById("OK_chapka");

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
        canvas_vid.setAttribute('width', width);
        canvas_vid.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    startbutton.addEventListener('click', function(ev){
      takepicture();
      ev.preventDefault();
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

  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      if (checkGlasses.checked == true){
        context.drawImage(glasses, 125, 100, 70, 15);
      }
      if (checkChapka.checked == true){
        context.drawImage(chapka, 110, 30, 100, 60);
      }
      if (checkChain.checked == true){
        context.drawImage(chain, 120, 150, 90, 50);
      }
      if (checkCanard.checked == true){
        context.drawImage(canard, 0, 180, 60, 60);
      }
      if (checkCouronne.checked == true){
        context.drawImage(couronne, 110, 20, 100, 60);
      }
      if (checkSuit.checked == true){
        context.drawImage(suit, 40, 160, 250, 80);
      }
      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
    } else {
      clearphoto();
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);

})();

