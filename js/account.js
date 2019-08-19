(function() {
  
    function modifMsg(xhr) {
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
            }
        }
        else {
          alert('Un problème est survenu avec la requête.');
        }
      }
    }

    function sendModif(xhr, url, param_modif, val_input) {
        xhr.onreadystatechange = function() {
            modifMsg(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (param_modif === "email")
            email = val_input;
        else if (param_modif === "uid")
            uid = val_input;
        
        if (param_modif === "pwd") {
            var oldPwd = document.getElementById("_oldpwd").value;
            xhr.send("update="+param_modif+"&newpwd="+val_input+"&oldpwd="+oldPwd);
        }
        else
            xhr.send("update="+param_modif+"&new_val="+val_input);
    }
  
    function makeRequest(url, param_modif, val_input) {
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
        sendModif(xhr, url, param_modif, val_input);
    }

    function removeValid(validBut) {
        var val_valid = validBut.value,
            input_valid = document.getElementById("_"+val_valid),
            tdBut = document.getElementById("button_"+val_valid),
            newBut = '<button class="modifier" id="modif_'+val_valid+'" type="submit" name="update" value="'+val_valid+'">Modifier</button>';
    
        tdBut.removeChild(validBut);
        tdBut.innerHTML = newBut;
        input_valid.style.backgroundColor = "";
        if (val_valid === "email")
            input_valid.value = email;
        else if (val_valid === "uid")
            input_valid.value = uid;
        else
            input_valid.value = "";
        input_valid.readOnly = true;

        if (val_valid === "pwd")
        {
            var tdpwd = document.getElementById("td_pwd"),
                rowOldpwd = document.getElementById("oldpwd");
                
            rowOldpwd.parentElement.removeChild(rowOldpwd);
            tdpwd.innerHTML = "Mot de passe :";
        }
        var butModif = document.getElementById("modif_"+val_valid)
        butModif.addEventListener('click', modifClick, false);
    }

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
    }
    
    function modifClick(){
        var valid = document.getElementsByClassName("valider"),
            errorMsg = document.getElementsByClassName("msg");

        if (valid[0])
            removeValid(valid[0]);
        if (errorMsg)
            removeMsg(errorMsg);
        
        var val_modif = this.value,
            input = document.getElementById("_"+val_modif),
            tdInput = document.getElementById("input_"+val_modif),
            type = (val_modif === "pwd") ? "password" : "text",
            newInput = '<input id="_'+val_modif+'" type="'+type+'" name="uid">';

        tdInput.removeChild(input);
        tdInput.innerHTML = newInput;

        var inputModif = document.getElementById("_"+val_modif);
        inputModif.setAttribute('style', 'background-color: rgba(255, 238, 181, 0.8)');
            
        if (val_modif === "pwd")
        {
            var tdpwd = document.getElementById("td_pwd"),
                trpwd = document.getElementById("pwd"),
                inputOldpwd = "<tr id='oldpwd'><td align='right'>Ancien mot de passe :</td><td><input id='_oldpwd' type='password' name='oldpwd' style='background-color: rgba(255, 238, 181, 0.8);'></td><td></td></tr>";
                
            tdpwd.innerHTML = "Nouveau mot de passe :";
            trpwd.insertAdjacentHTML('beforebegin', inputOldpwd);
        }
        
        var tdButModif = document.getElementById("button_"+val_modif),
            newValid = '<button class="valider" id="valid_'+val_modif+'" type="submit" name="update" value="'+val_modif+'">Valider</button>';

        tdButModif.removeChild(this);
        tdButModif.innerHTML = newValid;

        butValid = document.getElementById("valid_"+val_modif);

        butValid.addEventListener('click', function(ev){
            ev.preventDefault();

            var param_modif = this.value,
                val_input = document.getElementById("_"+param_modif).value;

            makeRequest('../include/modif.inc.php', param_modif, val_input);
        }, false);
    }


    var modif = document.getElementsByClassName("modifier"),
    email = document.getElementById("_email").value,
    uid = document.getElementById("_uid").value;

    Array.from(modif).forEach(function(element) {
        element.addEventListener('click', modifClick, false);
    });

  })();