<?php
if (!isset($_SESSION['u_id'])) {
    $_SESSION['erreur']['connect'] = "Pour accéder aux paramètres de votre compte connectez vous !";
	header('Location: ../fr/home.php?login=ask');
}
?>
<section class="settings">
        <h2 class="titre">Notifications</h2>
        <form>
        <table>
        <tr>
            <td><label class="switch">
            <span><?php echo $_SESSION['u_notif']?></span>
<?php 
if ($_SESSION['u_notif'] === '1') {?>
                <input type="checkbox" id="notif" checked>
<?php }
    else {?>
                <input type="checkbox" id="notif">
<?php   }?>
                <span class="slider round"></span>
            </label></td>
        </tr>
        </table>
        </form>
    </section>