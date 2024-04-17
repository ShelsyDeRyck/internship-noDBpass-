<?php
session_start();
require_once '../db_connect.php'; // Database connectie

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    // Als de gebruiker niet is ingelogd, stuur ze naar de inlogpagina
    header("Location: ../index.php");
    exit();
}

// Haal de gebruikers-ID en type op uit de sessie
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Controleer of het verzoek een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of alle vereiste velden zijn ingevuld
    if (isset($_POST['current_password'], $_POST['new_email'])) {
        // Haal de ingevoerde waarden op uit het formulier
        $current_password = $_POST['current_password'];
        $new_email = $_POST['new_email'];

        // Haal het opgeslagen wachtwoord en e-mailadres op uit de database op basis van het gebruikerstype
        $table_name = ($user_type === 'teacher') ? 'teachers' : 'admins';
        $stmt = $pdo->prepare("SELECT password, email FROM $table_name WHERE id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Verifieer het huidige wachtwoord
            if ($current_password === $result['password']) {
                // Wijzig het e-mailadres
                $update_stmt = $pdo->prepare("UPDATE $table_name SET email = ? WHERE id = ?");
                $update_stmt->execute([$new_email, $user_id]);
                echo "E-mailadres succesvol gewijzigd.";
            } else {
                echo "Huidig wachtwoord is onjuist.";
            }
        } else {
            echo "$user_type niet gevonden.";
        }
    } else {
        echo "Vul alle vereiste velden in.";
    }
}
?>
<!--
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" type="text/css" href="myaccount.css">
</head>
<body>
    <div class="container">
        <h1>My Account</h1>
        <form action="myaccountemail.php" method="POST">
            <div class="form-group">
                <label for="current_password">Huidig wachtwoord:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_email">Nieuw e-mailadres:</label>
                <input type="email" id="new_email" name="new_email" required>
            </div>
            <button type="submit" class="button">Wijzig E-mailadres</button>
        </form>
        <div class="message">
        </div>
    </div>
</body>
</html> -->
