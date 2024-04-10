<?php
session_start();
require_once 'db_connect.php'; // Bevat databaseconnectie

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Zoek de gebruiker in de database
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Admin gevonden, sla gebruikersgegevens op in de sessie
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['user_type'] = 'admin';

        // Stuur de admin naar het admin dashboard
        header('Location: dashboard_admin.php');
        exit;
    } else {
        // Geen admin gevonden, zoek in docenten tabel
        $stmt = $pdo->prepare("SELECT * FROM teachers WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($teacher) {
            // Docent gevonden, sla gebruikersgegevens op in de sessie
            $_SESSION['user_id'] = $teacher['id'];
            $_SESSION['user_type'] = 'teacher';

            // Stuur de docent naar het docent dashboard
            header('Location: dashboard_docent.php');
            exit;
        } else {
            // Gebruiker niet gevonden
            header('Location: login_fail.php');
            exit;
        }
    }
} else {
    // Geen geldige invoer ontvangen
    header('Location: login_fail.php');
    exit;
}
?>
