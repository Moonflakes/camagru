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
            //console.log(xhr.responseText);
            data = JSON.parse(xhr.responseText);
          
            var page = data['page'];
            var error = data['erreur'];
            
            if (page) {
                document.location.href="http://localhost:8100/camagru_git/fr/"+page;
            }
            else if (error) {
                var msgLog = document.getElementsByClassName("msg");

                if (msgLog)
                    removeMsg(msgLog);
                
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


})();