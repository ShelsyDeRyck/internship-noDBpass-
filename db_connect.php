<?php
// Function to establish a database connection using PDO
function connectPDO() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "educational_center";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        // If connection fails, throw an exception
        throw new Exception("PDO Connection failed: " . $e->getMessage());
    }
}

// Function to establish a database connection using mysqli
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "educational_center";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("MySQLi Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
