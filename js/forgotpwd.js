(function() {

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
      }

    function Forgot(xhr) {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                data = JSON.parse(xhr.responseText);

                var success = data['success'],
                    error = data['erreur'];

                    var errorMsg = document.getElementsByClassName("msg");

                    if (errorMsg)
                            removeMsg(errorMsg);

                    if (error){
                        var param = Object.keys(error),
                            str = Object.values(error);
        
                        param.forEach(function(elem, index) {
                            // console.log(elem)
                            var trParam = document.getElementById(elem),
                                trMsg = "<tr class='msg'><td style='padding-left:12px' colspan='2'><font color='red'>"+ str[index] +"</font></td></tr>";
        
                            trParam.insertAdjacentHTML('afterend', trMsg);
                        })
                    }

                if (success) {

                    if (msgLog)
                        removeMsg(msgLog);
                    window.scrollTo(0, 0);
                    var message = document.getElementsByClassName("message");
                    var logMsg = "<p class='msg'><font color='red'>"+ success +"</font></p>";
                    message[0].innerHTML = logMsg;
                }
            }
            else {
                alert('Un problème est survenu avec la requête.');
            }
        }
      }

    function sendForgot(xhr, url, email) {
        xhr.onreadystatechange = function() {
            Forgot(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          
        xhr.send("submit=OK&email="+email+"&uid="+uid);
    }

    function makeRequest(url, email, uid) {
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
        sendForgot(xhr, url, email, uid);
    }

    function clickForgot() {

        var email = document.getElementById("_email").value,
            uid = document.getElementById("_uid").value;

        makeRequest("../include/forgot_pwd.inc.php", email, uid);
    }

var forgotBut = document.getElementById("forgot");

forgotBut.addEventListener('click', clickForgot, false);
    
})();