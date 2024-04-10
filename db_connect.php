<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
