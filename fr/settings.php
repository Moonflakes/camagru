<html>
    <head>
        <title>Camagru - Paramètres</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../css/settings.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        body
        {
            font-family: monospace;
        }
    </style>
    <body> 
<?PHP
    include_once 'header.php';
?>
    <section class="settings">
        <!-- <h2>Thème</h2>
        <form action="/action_page.php" method="post">
        <table>
        <tr>
            <td><input type="checkbox" name="theme" value="basic" checked onchange='this.form.submit()'> Basic</td>
            <td><input type="checkbox" name="theme" value="bulles" onchange='this.form.submit()'> Bulles</td>
        </tr>
        </table>
        </form>
        <h2 class="titre">Langage</h2>
        <form action="/action_page.php" method="post">
        <table>
        <tr>
            <td><input type="checkbox" name="langage" value="fr" checked onchange='this.form.submit()'> fr</td>
            <td><input type="checkbox" name="langage" value="en" onchange='this.form.submit()'> en</td>
        </tr>
        </table>
        </form> -->
        <h2 class="titre">Notifications</h2>
        <!-- <form action="../include/notif.inc.php" method="post"> -->
        <form>
        <table>
        <tr>
            <!-- <td><input type="checkbox" name="notif" value="fr" checked="checkitof()"> Oui</td>
            <td><input type="checkbox" name="notif" value="en"> Non</td> -->
            <td><label class="switch">
                <input type="checkbox" checked id="notif">
                <span class="slider round"></span>
            </label></td>
        </tr>
        </table>
        </form>
    </section>
<?PHP
    include_once 'footer.php';
?>
    </body>
</html>
<!-- <script >
    function checkitof() {
        
    }
</script> -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>