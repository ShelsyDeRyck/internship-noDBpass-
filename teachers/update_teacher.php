<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "educational_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleren of de vereiste velden zijn ontvangen via POST
if(isset($_POST['id']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])) {
    // Ontvangen van POST-gegevens
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Voorbereiden van de SQL-query om de docent bij te werken
    $sql = "UPDATE teachers SET first_name=?, last_name=?, email=? WHERE id=?";

    // Voorbereiden van de statement
    $stmt = $conn->prepare($sql);

    if($stmt) {
        // Binden van parameters en uitvoeren van de statement
        $stmt->bind_param("sssi", $first_name, $last_name, $email, $id);
        if($stmt->execute()) {
            echo "Docent bijgewerkt successfully.";
        } else {
            echo "Er is een fout opgetreden bij het bijwerken van de docent.";
        }
    } else {
        echo "Er is een fout opgetreden bij het voorbereiden van de statement.";
    }

    // Sluiten van de statement en de databaseverbinding
    $stmt->close();
    $conn->close();
} else {
    echo "Niet alle vereiste velden zijn ontvangen.";
}
?>
