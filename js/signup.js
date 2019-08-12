(function() {
  
    function signMsg(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            var errorMsg = document.getElementsByClassName("msg");

            if (errorMsg)
                    removeMsg(errorMsg);
            if (data['error']){
                var param = Object.keys(data['error']),
                    str = Object.values(data['error']);

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

    function sendSign(xhr, url, inputs) {
        xhr.onreadystatechange = function() {
            signMsg(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        Array.from(inputs).forEach(function(element) {
            if (element.id === "_first")
                first_val = element.value;
            if (element.id === "_last")
                last_val = element.value;
            if (element.id === "_email")
                email_val = element.value;
            if (element.id === "_uid")
                uid_val = element.value;
            if (element.id === "_pwd")
                pwd_val = element.value;
        });
        xhr.send("first="+first_val+"&last="+last_val+"&email="+email_val+"&uid="+uid_val+"&pwd="+pwd_val+"&submit=ok");
    }
  
    function makeRequest(url, inputs) {
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
        sendSign(xhr, url, inputs);
    }

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
    }
    
    function signupClick(){
        var inputs = document.getElementsByClassName("input");

        makeRequest('../include/signup.inc.php', inputs);
    }

    var signupBut = document.getElementById("signup_but");

    signupBut.addEventListener('click', signupClick, false);

  })();