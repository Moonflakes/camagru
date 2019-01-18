(function() {

    function removeMsg(errorMsg) {
        Array.from(errorMsg).forEach(function(element) {
            element.parentElement.removeChild(element);
        });
    }

    function makeLogoutAccountBut(name) {
        var logoutBut = '<a class="ic logout" href="../include/logout.inc.php"><img src="../img_site/icones/logout_3.png" alt="logout" title="Déconnexion"><h4>Déconnexion</h4></a>',
            accountBut = '<a class="ic account" href="account.php"><div class="compte"><img src="../img_site/icones/account_green.png" alt="account" title="Mon compte"><div class="name">'+name+'</div></div><h4>Mon compte</h4></a>',
            rightIcones = document.getElementsByClassName("icones-right");
        
            console.log("je passe la");
            rightIcones[0].innerHTML = logoutBut+accountBut;
    }

    function Login(xhr) {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                //console.log(xhr.responseText);
                data = JSON.parse(xhr.responseText);

                error = data['error'];

                var msgLog = document.getElementsByClassName("msg");
                var loginDiv = document.getElementById("loginDiv");
    
                if (msgLog)
                    removeMsg(msgLog);

                if (data['success']) {
                    loginDiv.parentElement.removeChild(loginDiv);
                    var message = document.getElementsByClassName("message");
                    var logMsg = "<p class='msg'><font color='red'>"+ data['success'] +"</font></p>";
                    message[0].innerHTML = logMsg;

                    makeLogoutAccountBut(data['name']);
                }
                else if (error) {
                    var param = Object.keys(error),
                        str = Object.values(error);

                    loginDiv.insertAdjacentHTML('afterbegin', "<div id='msgError'></div>");
                    var divError = document.getElementById("msgError");
                    param.forEach(function(elem, index) {
                        var inputError = document.getElementById("_login_"+elem)
                            errorMsg = "<p class='msg'><font color='red'>"+ str[index] +"</font></p>";
                        
                        inputError.setAttribute('style', 'background-color: rgba(248, 207, 72, 0.3)');
                        divError.insertAdjacentHTML('beforeend', errorMsg);
                    })
                    var inscription = "<p class='msg'><font color='blue'>Si vous n'être pas encore inscrit, inscrivez-vous en cliquant sur Inscription !</font></p>",
                        forgotPwd = "<p class='msg'><font color='blue'><a href='forgot_pwd.php' id='fpwd-link'>Mot de passe oublié</a></font></p>";

                    divError.insertAdjacentHTML('beforeend', inscription+forgotPwd);
                    loginDiv.setAttribute('style', 'justify-content: space-between');
                }
            }
            else {
                alert('Un problème est survenu avec la requête.');
            }
        }
      }
    
    function sendLogin(xhr, url, uid, pwd) {
        xhr.onreadystatechange = function() {
            Login(xhr); 
        };
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          
        xhr.send("submit=OK&uid="+uid+"&pwd="+pwd);
    }
    
    function makeRequest(url, uid, pwd) {
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
        sendLogin(xhr, url, uid, pwd);
    }

    function connexionClick() {
        var uid = document.getElementById("_login_uid").value,
            pwd = document.getElementById("_login_pwd").value;

        makeRequest("../include/login.inc.php", uid, pwd);
    }

    function loginClick() {
        var divLogin = document.getElementById("loginDiv");
        var message = document.getElementsByClassName("message"),
            tableLog_uid = `<div class="login-div" id="loginDiv"><table class="login" ><tr><td><input id="_login_uid" type="text" name="uid" placeholder="Pseudo/e-mail"></td>`,
            tableLog_pwd = '<td><input id="_login_pwd" type="password" name="pwd" placeholder="Mot de passe"></td>',
            tableLog_but = '<td><button id="butLog" type="submit" name="submit">Connexion</button></td></tr></table></div>';

        if (divLogin)
            divLogin.parentElement.removeChild(divLogin);
        
        var logDiv = tableLog_uid+tableLog_pwd+tableLog_but;

        message[0].insertAdjacentHTML('beforebegin', logDiv);

        var butLog = document.getElementById("butLog");

        butLog.addEventListener('click', connexionClick, false);
        
    }

    var login = document.getElementById("login");

    if (login)
        login.addEventListener('click', loginClick, false);
    
    
})();