<?php
// leg [] voor fout meldding
$errors = [];
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord     = $_POST['wachtwoord'];

    if (empty($gebruikersnaam)) {
        $errors['gebruikersnaam'] = 'gebruikersnaam is niet ingevuld';
    }
    if (empty($wachtwoord)) {
        $errors['wachtwoord'] = 'E-mail adres is niet ingevuld';
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

            if (password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
                $_SESSION['id'] = $gebruiker['id'];
                $_SESSION['email'] = $gebruiker['email'];

                header("Location: admin.php");

                exit();
            }
        } else {
            $errors['gebruiker'] = 'Onbekend account';
            header("Location: home.php");
        }
    }
}
