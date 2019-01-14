(function() {
  
    function signMsg(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            /*
            if (data['error']){
                var param = Object.keys(data['error']),
                    str = Object.values(data['error']);

                param.forEach(function(elem, index) {
                    var trParam = document.getElementById(elem),
                        trMsg = "<tr class='msg'><td></td><td style='padding-left:12px' colspan='2'><font color='red'>"+ str[index] +"</font></td></tr>";

                    trParam.insertAdjacentHTML('afterend', trMsg);
                })
            }
            if (data['success'])
            {
                var param_v = Object.keys(data['success']),
                    str_v = Object.values(data['success']),
                    butValid = document.getElementById("valid_"+param_v[0]),
                    errorMsg = document.getElementsByClassName("msg");
                removeValid(butValid);
                if (errorMsg)
                    removeMsg(errorMsg);

                var trParam = document.getElementById(param_v[0]),
                    trMsg = "<tr class='msg'><td></td><td style='padding-left:12px' colspan='2'><font color='green'>"+ str_v[0] +"</font></td></tr>";

                trParam.insertAdjacentHTML('afterend', trMsg);
            }*/
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
            //console.log(element.value);
            if (element.id === "_first")
                var first = element.value;
            if (element.id === "_last")
                var last = element.value;
            if (element.id === "_email")
                var email = element.value;
            if (element.id === "_uid")
                var uid = element.value;
            if (element.id === "_pwd")
                var pwd = element.value;
        });
        xhr.send("first="+first+"&last="+last+"&email="+email+"&uid="+uid+"&pwd="+pwd+"&submit=ok");
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