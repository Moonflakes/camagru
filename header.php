<?PHP
    session_start();
?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
		<div id="header">
			<a href="index.php"><h1>Camagru</h1></a>
		</div>
        <nav>
            <div class="main-wrapper">
                <div class="nav-login">
<?php
    if (isset($_SESSION['u_id']))
    {
        echo '<form action="include/logout.inc.php" method="POST">
                <button type="submit" name="submit">Logout</button>
            </form>';
    }
    else
    {
        echo '<form id="login" action="include/login.inc.php" method="POST">
                <input type="text" name="uid" placeholder="Username/e-mail">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="submit">Login</button>
            </form>
            <a href="signup.php" id="signup-link">Sign up</a>';
    }
?>
                </div>
            </div>
        </nav>
    </body>
</html>