<?php
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Controleer of de student-ID is ontvangen via POST
if(isset($_POST['id'])) {
    // Ontvang de student-ID
    $id = $_POST['id'];

    // Maak een verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL-query voor het verwijderen van een student
    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Student successfully deleted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Sluit de verbinding met de database
    $conn->close();
} else {
    // Geen student-ID ontvangen, geef een foutmelding terug
    echo "Geen student-ID ontvangen";
}
?>