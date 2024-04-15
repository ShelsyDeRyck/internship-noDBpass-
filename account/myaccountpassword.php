<?php
session_start();
require_once '../db_connect.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: ../index.php");
    exit();
}

// Fetch the user ID and type from the session
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Controleer of het verzoek een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of alle vereiste velden zijn ingevuld
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        // Haal de ingevoerde waarden op uit het formulier
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Controleer of het nieuwe wachtwoord overeenkomt met het bevestigde wachtwoord
        if ($new_password === $confirm_password) {
            // Haal het opgeslagen wachtwoord op uit de database op basis van gebruikerstype
            $table_name = ($user_type === 'teacher') ? 'teachers' : 'admins';
            $stmt = $pdo->prepare("SELECT password FROM $table_name WHERE id = ?");
            $stmt->execute([$user_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Verifieer het huidige wachtwoord
                if ($current_password === $result['password']) {
                    // Wijzig het wachtwoord
                    $update_stmt = $pdo->prepare("UPDATE $table_name SET password = ? WHERE id = ?");
                    $update_stmt->execute([$new_password, $user_id]);
                    echo "Wachtwoord succesvol gewijzigd.";
                } else {
                    echo "Huidig wachtwoord is onjuist.";
                }
            } else {
                echo "$user_type niet gevonden.";
            }
        } else {
            echo "Nieuwe wachtwoorden komen niet overeen.";
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
        <form action="myaccountpassword.php" method="POST">
            <div class="form-group">
                <label for="current_password">Huidig wachtwoord:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nieuw wachtwoord:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Bevestig nieuw wachtwoord:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="button">Wijzig Wachtwoord</button>
        </form>
        
        <div class="message">
            
        </div>
    </div>
</body>
</html> --> 