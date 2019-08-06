(function() {

  function Lala(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
          
            // var page = data['page'];
            // var error = data['erreur'];
            
            // if (page) {
            //     document.location.href = page;
            // }
            // else if (error) {
            //     var msgLog = document.getElementsByClassName("msg");

            //     if (msgLog)
            //         removeMsg(msgLog);
            //     loginClick()
            //     window.scrollTo(0, 0);
            //     var message = document.getElementsByClassName("message");
            //     var logMsg = "<p class='msg'><font color='red'>"+ error +"</font></p>";
            //     message[0].innerHTML = logMsg;
            // }
      }
      else {
        alert('Un problème est survenu avec la requête.');
      }
    }
  }

  function sendNotif(xhr, url, notifState) {
    console.log("notifState", notifState)
    xhr.onreadystatechange = function() {
        Lala(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
    xhr.send("notifState="+notifState);
}

  function makeRequestNotif(url, notifState) {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        else {
            xhr = new XMLHttpRequest(); 
        }
    }

    if (!xhr) {
        alert('Abandon :( Impossible de créer une instance XMLHTTP');
        return false;
    }
    sendNotif(xhr, url, notifState);
}

  function notifClick() {
    var notifState = document.getElementById("notif").checked;

    // console.log(document.getElementById("notif").checked)

    makeRequestNotif("../include/notif.inc.php", notifState);
}

    var notif = document.getElementById('notif');

    notif.addEventListener('change', notifClick, false);

  
  })();