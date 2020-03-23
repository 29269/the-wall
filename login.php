<?php
$errors = [];

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST['wachtwoord'];

    $sql= 'SELECT * FROM `registreer` WHERE `gebruikersnaam` = :gebruikersnaam';
        $statement = $connection->prepare($sql );
        $params = [
            'gebruikersnaam' => $gebruikersnaam
        ];
        
        $result = $statement->execute($params);
        if ( $statement->rowCount() === 1 ) {
                $gebruiker = $statement->fetch();

        if (password_verify($gebruikersnaam, $wachtwoord['wachtwoord'])) {
            session_start();
            $_SESSION['id']= $gebruikersnaam['id'];
            $_SESSION['email']= $gebruikersnaam['email'];
            exit;
        }      
            } else {
                $errors['gebruikersnaam'] = 'Onbekend account';
            
            }
            

        }

?>