<?php
$hostname='localhost';
$username='root';
$password='';
$database='the_wall';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST['wachtwoord'];
}
try {
    $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM registreer";
    $statement = $connection->query($query);
    $errors = [];


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
        
        
    