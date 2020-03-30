<?php
// leg [] voor fout meldding
$errors = [];
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord     = $_POST['wachtwoord'];

    if (empty($email)) {
        $errors['email'] = 'E-mail adres is niet ingevuld';
    }
    if (empty($gebruikersnaam)) {
        $errors['gebruikersnaam'] = 'gebruikersnaam is niet ingevuld';
    }

    if (count($errors) === 0) {
        $connection = connect();
        $sql = 'SELECT * FROM `registreer` WHERE `gebruikersnaam` = :gebruikersnaam';
        $statement = $connection->prepare($sql);
        $params = [
            'gebruikersnaam' => $gebruikersnaam
        ];
        $statement->execute($params);
        // echo $statement->rowCount().'gevonden ';

        if ($statement->rowCount() === 1) {
            $gebruiker = $statement->fetch();

            if (password_verify($gebruikersnaam, $gebruiker['wachtwoord'])) {
                $_SESSION['id'] = $gebruiker['id'];
                $_SESSION['email'] = $gebruiker['email'];

                header("Location: admin.php");

                exit();
            }
        } else {
            $errors['gebruiker'] = 'Onbekend account';
        }
    }
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

<body>
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
                <?php if (!admin()) : ?>
                    <h2>SIGN IN</h2>
                <?php else : ?>
                    <a href="logout.php">LOGOUT</a>
                <?php endif; ?>
            </div>
            <div class="box">
                <h1>SIGN IN</h1>
                <!-- voor het fout melding heb ik foreach nodig -->


                <form action="home.php" method="POST" class="toevoegen">
                    <label for="titel">User name:</label><br>
                    <input type="gebruikersnaam" name="gebruikersnaam" placeholder="My name"><br>
                    <label for="titel">Password:</label><br>
                    <input type="password" name="wachtwoord" placeholder="My password"><br>
                    <?php if (isset($errors['gebruiker'])) : ?>
                        <?php echo $errors['gebruiker']; ?>
                    <?php endif; ?>

                    <button type="submit" name="login" class="login-button">Sign in</button>
                </form>
            </div>
        </div>
    </header>

    <script src="js/lightbox.js"></script>
</body>

</html>