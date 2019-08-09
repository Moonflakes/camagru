(function() {
  
    function resetpwdMsg(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            var errorMsg = document.getElementsByClassName("msg"),
                error = data['error'];

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
            if (data['success'])
            {
                var str_v = Object.values(data['success']);
                
                var table = document.getElementById("table"),
                    h2 = document.getElementsByClassName("h2sign"),
                    successMsg = "<font color='red'>"+str_v[0]+"</font>";

                table.parentElement.removeChild(table);
                h2[0].innerHTML = successMsg;
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