<?php 
require 'includes/functions.php';

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
            <title>Document</title>
        </head>
        <header>
        <img src="img/logo.png" alt="the_wall">
        <a href="logout.php">LOGOUT</a>
        </header>
        <body>
            <h3>welcom<?php echo $gebruikersnaam?></h3>
        </body>
        </html>