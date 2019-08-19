(function() {
  
    function deleteMsg(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);

            var msgLog = document.getElementsByClassName("msg");

            if (msgLog)
                removeMsg(msgLog);
            
            if (data['error']){
                var param = Object.keys(data['error']),
                    str = Object.values(data['error']);

                param.forEach(function(elem, index) {
                    var trParam = document.getElementById(elem),
                        trMsg = "<tr class='msg'><td></td><td style='padding-left:12px' colspan='2'><font color='red'>"+ str[index] +"</font></td></tr>";

                    trParam.insertAdjacentHTML('afterend', trMsg);
                })
            }
            if (data['success'] && data['page'])
            {
                document.location.href = data['page'];
            }
        }
        else {
          alert('Un problème est survenu avec la requête.');
        }
      }
    }

    function sendDelete(xhr, url) {
        var first = document.getElementById("_first").value,
            last = document.getElementById("_last").value,
            email = document.getElementById("_email").value,
            pwd = document.getElementById("_pwd").value,
            uid = document.getElementById("_uid").value;

        xhr.onreadystatechange = function() {
            deleteMsg(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.send("first="+first+"&last="+last+"&email="+email+"&uid="+uid+"&pwd="+pwd);
    }
  
    function makeRequest(url) {
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
        sendDelete(xhr, url);
    }

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
    }
    
    function deleteClick(){
        makeRequest('../include/delete_account.inc.php');
    }


    var deleteAccount = document.getElementsByClassName("delete");
    

    deleteAccount[0].addEventListener('click', deleteClick, false);

  })();