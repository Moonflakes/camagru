(function() {
//MISE EN FORME DES COLONNES
function smallH()
{
    tab = Array.prototype.slice.call(arguments);
    return (tab.indexOf(Math.min(...tab)) + 1);
}

function organisation(nbcol)
{
    var column;
    var item;
    var i = 0;
    var h1 = 0;
    var h2 = 0;
    var h3 = 0;
    var h4 = 0;

    
    if (nbcol === 1)
    {
        column = document.getElementById('column1');
        //mettre les éléments dans la div
        while (item = document.getElementById('item'+(++i)))
            column.appendChild(item);
    }
    else if (nbcol === 2)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i == 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i == 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2));
                column.appendChild(item);
                if (smallH(h1, h2) == 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
            }
        }
    }
    else if (nbcol === 3)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i === 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i === 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else if (i === 3)
            {
                column = document.getElementById('column3');
                column.appendChild(item);
                h3 = item.offsetHeight + h3;
                console.log("offsetH item", i," : ", h3, "colonne3");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2, h3));
                column.appendChild(item);
                if (smallH(h1, h2, h3) === 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else if (smallH(h1, h2, h3) === 2)
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
                else
                {
                    h3 = item.offsetHeight + h3;
                    console.log("offsetH item", i," : ", h3, "colonne3");
                }
            }
        }
    }
    else if (nbcol === 4)
    {
        while (item = document.getElementById('item'+(++i)))
        {
            if (i === 1)
            {
                column = document.getElementById('column1');
                column.appendChild(item);
                h1 = item.offsetHeight + h1;
                console.log("offsetH item", i," : ", h1, "colonne1");
            }
            else if (i === 2)
            {
                column = document.getElementById('column2');
                column.appendChild(item);
                h2 = item.offsetHeight + h2;
                console.log("offsetH item", i," : ", h2, "colonne2");
            }
            else if (i === 3)
            {
                column = document.getElementById('column3');
                column.appendChild(item);
                h3 = item.offsetHeight + h3;
                console.log("offsetH item", i," : ", h3, "colonne3");
            }
            else if (i === 4)
            {
                column = document.getElementById('column4');
                column.appendChild(item);
                h4 = item.offsetHeight + h4;
                console.log("offsetH item", i," : ", h4, "colonne4");
            }
            else
            {
                column = document.getElementById('column'+smallH(h1, h2, h3, h4));
                column.appendChild(item);
                if (smallH(h1, h2, h3, h4) === 1)
                {
                    h1 = item.offsetHeight + h1;
                    console.log("offsetH item", i," : ", h1, "colonne1");
                }
                else if (smallH(h1, h2, h3, h4) === 2)
                {
                    h2 = item.offsetHeight + h2;
                    console.log("offsetH item", i," : ", h2, "colonne2");
                }
                else if (smallH(h1, h2, h3, h4) === 3)
                {
                    h3 = item.offsetHeight + h3;
                    console.log("offsetH item", i," : ", h3, "colonne3");
                }
                else
                {
                    h4 = item.offsetHeight + h4;
                    console.log("offsetH item", i," : ", h4, "colonne4");
                }
            }
        }
    }
}

function createColumns(largeur)
{
    var grid = document.getElementById("grid");
    var column1 = document.getElementById('column1');
    var column3 = document.getElementById('column3');
    var column2 = document.getElementById('column2');
    var column4 = document.getElementById('column4');
    var nbcol = 0;

    if (column1 == undefined)
    {
        column1 = document.createElement('div');
        column1.setAttribute("id", "column1");
        column1.setAttribute("class", "column");
        grid.appendChild(column1);
        nbcol = 1;
    }
    if (column2 == undefined)
    {
        if (largeur > 700)
        {
            //create column
            column2 = document.createElement('div');
            column2.setAttribute("id", "column2");
            column2.setAttribute("class", "column");
            grid.appendChild(column2);
            nbcol = 2;
        }
    }
    else
    {
        if (largeur < 700)
        {
            // reorganisation 
            organisation(1);
            
            //remove column
            grid.removeChild(column2);
            if (column3)
                grid.removeChild(column3);
            if (column4)
                grid.removeChild(column4);
            return;
        }
    }
    if (column3 == undefined)
    {
        if (largeur > 1300)
        {
            column3 = document.createElement('div');
            column3.setAttribute("id", "column3");
            column3.setAttribute("class", "column");
            grid.appendChild(column3);
            nbcol = 3;
        }
    }
    else
    {
        if (largeur < 1300)
        {
            // reorganisation 
            organisation(2);

            // remove column
            grid.removeChild(column3);
            if (column4)
                grid.removeChild(column4);
            return;
        }
    }
    if (column4 == undefined)
    {
        if (document.body.clientWidth > 1700)
        {
            column4 = document.createElement('div');
            column4.setAttribute("id", "column4");
            column4.setAttribute("class", "column");
            grid.appendChild(column4);
            nbcol = 4;
        }
    }
    else
    {
        if (document.body.clientWidth < 1700)
        {
            // reorganisation 
            organisation(3);

            // remove column
            grid.removeChild(column4);
            return;
        }
    }
    organisation(nbcol);
}


var largeur = document.body.clientWidth;
       
createColumns(largeur);

//controler la largeur de la fenetre
this.addEventListener('resize',function(){
    largeur = document.body.clientWidth;
    createColumns(largeur);
});


// PARTIE LIKE
function modifLike(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            //console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
          
            var nblike = data['nb_likes'];
            var type = data['type'];
            var id = data['id'];
            var imgCoeur = document.getElementById("img_coeur_"+id),
                nbLike_ = document.getElementById("nblike_"+id);
            var msgLog = document.getElementsByClassName("msg");

            if (msgLog)
                removeMsg(msgLog);
                
            if(type == 'like'){
                // mettre le coeur en rose
                imgCoeur.setAttribute('src', src_like);
                imgCoeur.setAttribute('title', "Je n'aime pas");
                nbLike_.innerHTML = nblike;
            }
            else if (type == 'unlike'){
                // mettre le coeur vide
                imgCoeur.setAttribute('src', src_unlike);
                imgCoeur.setAttribute('title', "Je n'aime pas");
                nbLike_.innerHTML = nblike;
            }
            else if (data['erreur']) {
                var message = document.getElementsByClassName("message");
                var logMsg = "<p class='msg'><font color='red'>"+ data['erreur'] +"</font></p>";
                message[0].innerHTML = logMsg;
                loginClick()
                window.scrollTo(0, 0);
            }
      }
      else {
        alert('Un problème est survenu avec la requête.');
      }
    }
  }

function sendLike(xhr, url, id_pict) {
    xhr.onreadystatechange = function() {
        modifLike(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
    xhr.send("like="+id_pict);
}

function makeRequest(url, id_pict, action) {
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
    if (action === "like")
        sendLike(xhr, url, id_pict);
    else if (action === "comment")
        sendComment(xhr, url, id_pict)
}

function coeurClick() {
    var id = this.id;   // Getting Button id
    var split_id = id.split("_");
    var id = split_id[1];
    var like = document.getElementById("coeur_"+id).value;

    makeRequest('../include/like.php', like, "like");
}

function removeMsg(errorMsg) {
    Array.from(errorMsg).forEach(function(element) {
        element.parentElement.removeChild(element);
    });
}

var src_like = '../img_site/icones/coeur_rose.png';
var src_unlike = '../img_site/icones/coeur.png';
var coeur = document.getElementsByClassName("coeur");

Array.from(coeur).forEach(function(element) {
    element.addEventListener('click', coeurClick, false);
});

// PARTIE COMMENTAIRE
function goComment(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
          
            var page = data['page'];
            var error = data['erreur'];
            
            if (page) {
                document.location.href = page;
            }
            else if (error) {
                var msgLog = document.getElementsByClassName("msg");

                if (msgLog)
                    removeMsg(msgLog);
                loginClick()
                window.scrollTo(0, 0);
                var message = document.getElementsByClassName("message");
                var logMsg = "<p class='msg'><font color='red'>"+ error +"</font></p>";
                message[0].innerHTML = logMsg;
            }
      }
      else {
        alert('Un problème est survenu avec la requête.');
      }
    }
  }

function sendComment(xhr, url, id_pict) {
    xhr.onreadystatechange = function() {
        goComment(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
    xhr.send("comment="+id_pict);
}

function commentClick() {
    makeRequest('../include/comment.inc.php', this.value, "comment");
}

var butCom = document.getElementsByClassName("comment");

Array.from(butCom).forEach(function(element) {
    element.addEventListener('click', commentClick, false);
});

// PARTIE GO TO WEBCAM
function goToPage(xhr) {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
            // console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
          
            var page = data['page'];
            var error = data['erreur'];
            
            if (page) {
                document.location.href = page;
            }
            else if (error) {
                var msgLog = document.getElementsByClassName("msg");

                if (msgLog)
                    removeMsg(msgLog);
                loginClick()
                window.scrollTo(0, 0);
                var message = document.getElementsByClassName("message");
                var logMsg = "<p class='msg'><font color='red'>"+ error +"</font></p>";
                message[0].innerHTML = logMsg;
            }
      }
      else {
        alert('Un problème est survenu avec la requête.');
      }
    }
  }

function sendGoTo(xhr, url, goTo) {
    xhr.onreadystatechange = function() {
        goToPage(xhr); 
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
    xhr.send("goTo="+goTo);
}

function makeRequestGoTo(url, goTo) {
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
    sendGoTo(xhr, url, goTo);
}

function takePictClick() {
    makeRequestGoTo('../include/goto.inc.php', "webcam");
}

var butTakePict = document.getElementById("take_pict");

if (butTakePict)
    butTakePict.addEventListener('click', takePictClick, false);

// PARTIE GO TO SETTINGS

function settingsClick() {
    makeRequestGoTo('../include/goto.inc.php', "settings");
}

var butSettings = document.getElementById("settings");

if (butSettings)
    butSettings.addEventListener('click', settingsClick, false);

// PARTIE LOGIN
function makeRequestLogin(url, uid, pwd) {
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

function removeMsg(errorMsg) {
    Array.from(errorMsg).forEach(function(element) {
        element.parentElement.removeChild(element);
    });
}

function makeLogoutAccountBut(name) {
    var logoutBut = '<a class="ic logout" href="../include/logout.inc.php"><img src="../img_site/icones/logout_3.png" alt="logout" title="Déconnexion"><h4>Déconnexion</h4></a>',
        accountBut = '<a class="ic account" href="account.php"><div class="compte"><img src="../img_site/icones/account_green.png" alt="account" title="Mon compte"><div class="name">'+name+'</div></div><h4>Mon compte</h4></a>',
        rightIcones = document.getElementsByClassName("icones-right");

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

                if (message[0])
                    message[0].innerHTML = logMsg;
                else {
                    header[0].insertAdjacentHTML('afterend', "<div class='message'>"+logMsg+"</div>");
                }

                makeLogoutAccountBut(data['name']);
            }
            else if (error) {
                var param = Object.keys(error),
                    str = Object.values(error);
                var flag = 0;
                loginDiv.insertAdjacentHTML('afterbegin', "<div id='msgError'></div>");
                var divError = document.getElementById("msgError");
                param.forEach(function(elem, index) {
                    var inputError = document.getElementById("_login_"+elem)
                        errorMsg = "<p class='msg'><font color='red'>"+ str[index] +"</font></p>";
                    
                    if (str[index] === "Mot de passe incorrect !")
                        flag = 1;
                    inputError.setAttribute('style', 'background-color: rgba(248, 207, 72, 0.3)');
                    divError.insertAdjacentHTML('beforeend', errorMsg);
                })
                
                var inscription = "<p class='msg'><font color='blue'>Si vous n'être pas encore inscrit, inscrivez-vous en cliquant sur Inscription !</font></p>",
                    forgotPwd = "<p class='msg'><font color='blue'><a href='forgot_pwd.php' id='fpwd-link'>Mot de passe oublié</a></font></p>";

                if (flag === 1)
                    divError.insertAdjacentHTML('beforeend', forgotPwd);
                else
                    divError.insertAdjacentHTML('beforeend', inscription);
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

function connexionClick() {
    var uid = document.getElementById("_login_uid").value,
        pwd = document.getElementById("_login_pwd").value;

    makeRequestLogin("../include/login.inc.php", uid, pwd);
}

function loginClick() {
    var divLogin = document.getElementById("loginDiv");
    var tableLog_uid = `<div class="login-div" id="loginDiv"><table class="login" ><tr><td><input id="_login_uid" type="text" name="uid" placeholder="Pseudo/e-mail"></td>`,
        tableLog_pwd = '<td><input id="_login_pwd" type="password" name="pwd" placeholder="Mot de passe"></td>',
        tableLog_but = '<td><button id="but_Log" type="submit" name="submit">Connexion</button></td></tr></table></div>';

    if (divLogin)
        divLogin.parentElement.removeChild(divLogin);
    
    var logDiv = tableLog_uid+tableLog_pwd+tableLog_but;

    header[0].insertAdjacentHTML('afterend', logDiv);

    var butLog = document.getElementById("but_Log");

    butLog.addEventListener('click', connexionClick, false);
    
}

var login = document.getElementById("login"),
    header = document.getElementsByClassName("header"),
    GET = location.search.substring(1).split('&');

if (login)
    login.addEventListener('click', loginClick, false);
if (GET && GET[0] === "login=ask")
    loginClick()


})();