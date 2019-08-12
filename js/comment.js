(function() {

  function removeMsg(errorMsg) {
    Array.from(errorMsg).forEach(function(element) {
        element.parentElement.removeChild(element);
    });
  }
  
    function commentPict(xhr) {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
            
            var author = data['author'],
                text = data['text'],
                time = data['time'],
                id = data['id'],
                error = data['erreur'];

            if (error) {
              var msgLog = document.getElementsByClassName("msg");

                if (msgLog)
                    removeMsg(msgLog);
                window.scrollTo(0, 0);
                var message = document.getElementsByClassName("message");
                var logMsg = "<p class='msg'><font color='red'>"+ error +"</font></p>";
                message[0].innerHTML = logMsg;
            }
            else {
              text = text.replace(/\n/g,'<br />');

              var old = document.getElementsByClassName("old");
              var newMsg = '<div class="old-msg_'+id+'"><div class="msg_comment"><b>'+author+'</b><span> : '+text+'</span></div><span class="time" id="time_'+id+'">il y a '+time[0]+'</span></div><br>';
              old[0].insertAdjacentHTML('afterbegin', newMsg);
              
              $.each(time,function(index,element){
                  t = document.getElementById('time_'+index);
                  t.innerHTML = element;
              });
            }
  
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
          } catch(e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
          }
        } else {
          xhr = new XMLHttpRequest(); 
        }
  
      }
  
      if (!xhr) {
        alert('Abandon :( Impossible de créer une instance XMLHTTP');
        return false;
      }
      sendComment(xhr, url, text, id_pict);
    }

    var button = document.getElementById('button'),
        comment = document.getElementById('comment');

    button.addEventListener('click', function(ev){
        ev.preventDefault();

        var text = comment.value,
            id_pict = button.value;
        makeRequest('../include/add_comment.php', text, id_pict);
      }, false);
  
  })();
  
  