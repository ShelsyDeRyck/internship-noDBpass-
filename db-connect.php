<?php

// Database configuratie
$host = "localhost";
$database = "educational_center";
$username = "root";
$password = "root";

// PDO connectie string
$dsn = "mysql:host=$host;dbname=$database";

// Maak een PDO object
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Kon geen verbinding maken met de database: " . $e->getMessage());
}

// Stel de PDO-foutmodus in (optioneel)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// De $pdo variabele is nu beschikbaar in andere scripts

?>