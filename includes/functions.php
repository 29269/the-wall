<?php
session_start();
function connect()
{
    $config = require(__DIR__ . '/config.php');


    try {
        $connection = new PDO('mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'], $config['username'], $config['password']);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        echo 'Fout bij database verbinding: ' . $e->getMessage() . ' op regel ' . $e->getLine() . ' in ' . $e->getFile();
    }
    return false;
}

function notAdmin()
{

    if (!admin()) {
        header('Location: home.php');
    }
}

function admin()
{

    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}
