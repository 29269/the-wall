<?php
$hostname='localhost';
$username='root';
$password='';
$database='the_wall';



try {
    $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM registreer";
    $statement = $connection->query($query);
    
    
} catch(PDOException $e) {
    echo 'Fout bij database verbinding: ' . $e->getMessage() . ' op regel ' . $e->getLine() . ' in ' . $e->getFile();
    echo 'Fout bij SQL query:<br>' . $e->getMessage() . ' op regel ' . $e->getLine() . ' in ' . $e->getFile();
}
$gebruikersnaam = $_POST["gebruikersnaam"];
$email = $_POST["email"];
$wachtwoord = $_POST["wachtwoord"];

$safe_wachtwoord = password_hash("$wachtwoord", PASSWORD_DEFAULT);
echo $safe_wachtwoord;

   $stmt = $connection->prepare("INSERT INTO registreer (gebruikersnaam, email, wachtwoord) VALUES (:gebruikersnaam, :email, :wachtwoord)");
   $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
 
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':wachtwoord', $safe_wachtwoord);
 
 
   // Voer het SQL statement uit
   header('Location: login.html');
   $stmt->execute();

   
  ?>