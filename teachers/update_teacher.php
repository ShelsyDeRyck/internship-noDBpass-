<?php
// Include database connection file
include_once "../db_connect.php";

// Establish database connection using MySQLi
$conn = connectDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Controleren of de vereiste velden zijn ontvangen via POST
if(isset($_POST['id']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Ontvangen van POST-gegevens
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Add password field

    // Voorbereiden van de SQL-query om de docent bij te werken, inclusief wachtwoord
    $sql = "UPDATE teachers SET first_name=?, last_name=?, email=?, password=? WHERE id=?";

    // Voorbereiden van de statement
    $stmt = $conn->prepare($sql);

    if($stmt) {
        // Binden van parameters en uitvoeren van de statement
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $id); // Adjust bind_param to include password
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
