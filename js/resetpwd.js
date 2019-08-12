(function() {
  
    function resetpwdMsg(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            var errorMsg = document.getElementsByClassName("msg"),
                error = data['error'],
                erKey = data['key'];

            if (errorMsg)
                    removeMsg(errorMsg);
            if (error){
                var param = Object.keys(error),
                    str = Object.values(error);

                param.forEach(function(elem, index) {
                    var trParam = document.getElementById(elem),
                        trMsg = "<tr class='msg'><td style='padding-left:12px' colspan='2'><font color='red'>"+ str[index] +"</font></td></tr>";

                    trParam.insertAdjacentHTML('afterend', trMsg);
                })
            }
            if (erKey) {
                var logMsg = "<p class='msg'><font color='red'>"+ erKey +"</font></p>";

                if (message[0])
                    message[0].innerHTML = logMsg;
                else {
                    header[0].insertAdjacentHTML('afterend', "<div class='message'>"+logMsg+"</div>");
                }
            }
            if (data['success'])
            {
                var logMsg = "<p class='msg'><font color='red'>"+ data['success'] +"</font></p>";

                if (message[0])
                    message[0].innerHTML = logMsg;
                else {
                    header[0].insertAdjacentHTML('afterend', "<div class='message'>"+logMsg+"</div>");
                }
            }
        }
        else {
          alert('Un problème est survenu avec la requête.');
        }
      }
    }

    function sendResetpwd(xhr, url, pwd, uid, key) {
        xhr.onreadystatechange = function() {
            resetpwdMsg(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.send("uid="+uid+"&pwd="+pwd+"&submit="+key);
    }
  
    function makeRequest(url, pwd, uid, key) {
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
        sendResetpwd(xhr, url, pwd, uid, key);
    }

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
    }
    
    function resetpwdClick(){
        var pwd = document.getElementById("_pwd").value,
            uid = document.getElementById("_uid").value,
            key = resetpwdBut.value;

        makeRequest("../include/reset_pwd.inc.php", pwd, uid, key);
    }

    var resetpwdBut = document.getElementById("resetpwd");

    resetpwdBut.addEventListener('click', resetpwdClick, false);

    var message = document.getElementsByClassName("message");

    message[0].innerHTML = "<p></p>";

  })();