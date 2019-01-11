(function() {
  
   /* function commentPict(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            //console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            
            var author = data['author'],
                text = data['text'],
                time = data['time'],
                id = data['id'];
            
            text = text.replace(/\n/g,'<br />');

            var old = document.getElementsByClassName("old");
            var newMsg = '<div class="old-msg_'+id+'"><div class="msg"><b>'+author+'</b><span> : '+text+'</span></div><span class="time" id="time_'+id+'">il y a '+time[0]+'</span></div><br>';
            old[0].insertAdjacentHTML('afterbegin', newMsg);
            
            $.each(time,function(index,element){
                t = document.getElementById('time_'+index);
                t.innerHTML = element;
            });
  
        }
        else {
          alert('Un problème est survenu avec la requête.');
        }
      }
    }
  
    function sendComment(xhr, url, text, id_pict) {
        xhr.onreadystatechange = function() {
            commentPict(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
        xhr.send("text="+text+"&id_pict="+id_pict);
    }
  
    function makeRequest(url, text, id_pict) {
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
        sendComment(xhr, url, text, id_pict);
    }*/

    var modif = document.getElementsByClassName("modifier"),
        valid = document.getElementsByClassName("valider"),
        email = document.getElementById("_email").value,
        uid = document.getElementById("_uid").value;

    Array.from(modif).forEach(function(element) {
        element.addEventListener('click', function(ev){
            ev.preventDefault();
            
            if (valid[0])
            {
                var val_valid = valid[0].value,
                input_valid = document.getElementById("_"+val_valid);

                valid[0].innerHTML = "Modifier";
                valid[0].className = "modifier";
                input_valid.style.backgroundColor = "";
                if (val_valid === "email")
                    input_valid.value = email;
                else if (val_valid === "uid")
                    input_valid.value = uid;
                input_valid.readOnly = true;

                if (val_valid === "pwd")
                {
                    var tdpwd = document.getElementById("td_pwd"),
                        table = document.getElementsByClassName("account-form"),
                        tr = document.getElementById("oldpwd");
                    
                    table[0].deleteRow(4);
                    tdpwd.innerHTML = "Mot de passe :";
                }
            }
            var val_modif = element.value,
                input = document.getElementById("_"+val_modif);

            input.value = "";
            input.removeAttribute("readonly");
            input.setAttribute('style', 'background-color: rgba(255, 238, 181, 0.8)');
            
            if (val_modif === "pwd")
            {
                var tdpwd = document.getElementById("td_pwd"),
                    formpwd = document.getElementById("form_pwd"),
                    inputOldpwd = "<tr id='oldpwd'><td align='right'>Ancien mot de passe :</td><td><input id='_oldpwd' type='password' name='oldpwd' style='background-color: rgba(255, 238, 181, 0.8);'></td><td></td></tr>";
                
                tdpwd.innerHTML = "Nouveau mot de passe :";
                formpwd.insertAdjacentHTML('afterend', inputOldpwd);
            }
            
            element.innerHTML = "Valider";
            element.className = "valider";
          }, false);
    });

    if (valid[0]) {
        valid[0].addEventListener('click', function(ev){
            ev.preventDefault();
    
            makeRequest('../include/modif.inc.php', text, id_pict);
          }, false);
    }
  
  })();