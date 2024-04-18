<?php
session_start();

// Check if the user is logged in and has a user type set in the session
if (isset($_SESSION['user_type'])) {
    // Include the navbar based on the user type
    if ($_SESSION['user_type'] === 'admins') {
        include('../includes/navbar_admin.php');
    } elseif ($_SESSION['user_type'] === 'teachers') {
        include('../includes/navbar_docent.php');
    }
} else {
    // If user is not logged in, redirect to login page
    header('Location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Wijzig Account</title>
    <link rel="stylesheet" type="text/css" href="../styles/account.css">
    <?php include('../includes/bootstrap.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2>Wijzig Account Gegevens</h2>
            <div class="col-md m-3 email">
                <div class="emailWijziging m-3">
                    <h4>Email wijzigen</h4>
                    <form action="myaccountemail.php" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label" for="current_password">Huidig emailadres:</label>
                            <input class="form-control" type="email" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="new_email">Nieuw e-mailadres:</label>
                            <input class="form-control" type="email" id="new_email" name="new_email" required>
                        </div>
                        <button type="submit" class="btn btn-outline-secondary">Wijzig E-mailadres</button>
                    </form>
                    <!-- Placeholder voor berichten na het wijzigen van het e-mailadres -->
                    <div class="message">
                        <!-- Berichten na het wijzigen van het e-mailadres zullen hier verschijnen -->
                    </div>
                </div>
            </div>
            <div class="col-md m-3 wachtwoord">
                <div class="wachtwoordWijziging m-3">
                    <h4>Wachtwoord wijzigen</h4>
                    <form action="myaccountpassword.php" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label" for="current_password">Huidig wachtwoord:</label>
                            <input class="form-control" type="password" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="new_password">Nieuw wachtwoord:</label>
                            <input class="form-control" type="password" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="confirm_password">Bevestig nieuw wachtwoord:</label>
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-outline-light">Wijzig Wachtwoord</button>
                    </form>
                    <!-- Placeholder voor berichten na het wijzigen van het wachtwoord -->
                    <div class="message">
                        <!-- Berichten na het wijzigen van het wachtwoord zullen hier verschijnen -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include('../includes/footer.php'); ?>