<?php

// Database configuration
$host = 'localhost'; // Database host (e.g., localhost)
$dbname = 'educational_center'; // Database name
$username = 'root'; // Database username
$password = 'root'; // Database password

// Attempt to create a PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If PDO fails to connect, output the error
    echo 'Connection failed: ' . $e->getMessage();
    exit(); // Exit the script
}