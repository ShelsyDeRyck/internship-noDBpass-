<?php
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Controleren of de cursus-ID is ontvangen via POST
if(isset($_POST['id'])) {
    // Ontvang de cursus-ID
    $id = $_POST['id'];

    // Databaseverbinding maken
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL-query voor het verwijderen van een cursus
    $sql = "DELETE FROM courses WHERE course_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Cursus succesvol verwijderd";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Databaseverbinding sluiten
    $conn->close();
} else {
    // Geen cursus-ID ontvangen, geef een foutmelding terug
    echo "Geen cursus-ID ontvangen";
}
?>