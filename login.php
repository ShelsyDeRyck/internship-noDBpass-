<?php

require_once 'db-connect.php'; // Bevat databaseconnectie

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Zoek de gebruiker in de database
  $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
  $stmt->execute([$email, $password]);
  $admin = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$admin) {
    // Geen admin gevonden, zoek in docenten tabel
    $stmt = $pdo->prepare("SELECT * FROM docenten WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      // Gebruiker niet gevonden
      header('Location: login_fail.php');
      exit;
    }

    // ... Voer hier de acties uit na een succesvolle docent login ...

    // Voorbeeld: stuur de docent naar het dashboard
    header('Location: docent_dashboard.php');
    exit;
  }

  // ... Voer hier de acties uit na een succesvolle admin login ...

  // Voorbeeld: stuur de admin naar het admin panel
  header('Location: admin.php');
  exit;
}

?>