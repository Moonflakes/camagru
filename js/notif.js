(function() {

  function sendNotif(xhr, url, notifState) {
    console.log("notifState", notifState)
    xhr.onreadystatechange = function() {
        // Lala(xhr); 
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
    var notifState = notif.checked;

    makeRequestNotif("../include/notif.inc.php", notifState);
}

    var notif = document.getElementById('notif');

    notif.addEventListener('change', notifClick, false);
  })();