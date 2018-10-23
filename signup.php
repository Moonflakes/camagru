<?PHP
    include_once 'header.php';
?>
    <section class="main-container">
        <div class="main-wrapper">
            <h2 class="h2sign" >Sign Up</h2>
            <form class="signup-form" action="include/signup.inc.php" method="POST">
                <input type="text" name="first" placeholder="Fisrtname">
                <input type="text" name="last" placeholder="Lastname">
                <input type="text" name="email" placeholder="E-mail">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="submit">Sign up</button>
            </form>
        </div>
    </section>

<?PHP
    $sql = "SELECT * FROM users;";
    $result = mysqli_query($connexion, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            echo $row['user_uid']."<br>";
        }
    }
?>
<?PHP
    include_once 'footer.php';
?>