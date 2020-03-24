<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'the_wall';

try {
    $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM registreer";
    $statement = $connection->query($query);
} catch (PDOException $e) {
    echo 'Fout bij database verbinding: ' . $e->getMessage() . ' op regel ' . $e->getLine() . ' in ' . $e->getFile();
}
function signIn(){

    global $_SESSION;
    if (isset($_SESSION['gebruikers_id'])){
        return true;
    }
       return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="The Wall">
    <meta name="keywords" content="HTML,CSS,PHP">
    <meta name="author" content="Ruben Cali and Duneya Saleh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="og:title" property="og:title" content="The wall">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="img/jpg" href="img/logo.png">
    <title>sign_in</title>
</head>
<header>
<img src="img/logo.png" alt="the_wall">
<div>
<div class="first">
    <h2>Register</h2>
</div>
<div class="box">
    <h1>Register</h1>
    <form action="save_user.php" method="POST" class="toevoegen">
        <label for="titel">User name:</label><br>
        <input type="text" name="gebruikersnaam" placeholder="My name"><br>
        <label for="titel">E-mail address:</label><br>
        <input type="email" name="email" placeholder="My e-mail address"><br>
        <label for="titel">Password:</label><br>
        <input type="password" name="wachtwoord" placeholder="My password"><br>
        <label for="titel">Repeat password:</label><br>
        <input type="password" name="wachtwoord" placeholder="My repeat password"><br>
        <button type="submit" name="Register">Register</button>

    </form>
</div>
<div class="first">
    <?php if (! signIn() ) ; ?>
    <h2>SIGN IN</h2>

</div>
<div class="box">
    <h1>SIGN IN</h1>
    <form action="login.php" method="POST" class="toevoegen">
        <label for="titel">User name:</label><br>
        <input type="gebruikersnaam" name="gebruikersnaam" placeholder="My name"><br>
        <label for="titel">Password:</label><br>
        <input type="password" name="wachtwoord" placeholder="My password"><br>
        <button type="submit" name="sign_in" class="login-button">Sign in</button>
    </form>
</div>
</div>
</header>
<body>
    <script src="js/lightbox.js"></script>
</body>
</html>