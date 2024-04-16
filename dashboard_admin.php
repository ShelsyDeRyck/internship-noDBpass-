<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admins') {
    header('Location: index.php'); // Redirect to login page if not authorized
    exit;
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>    
    <?php include ('includes/bootstrap.php'); ?>
    <link rel="stylesheet" href="./styles/admin.css">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>

<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav firstnav">
            <a class="navbar-brand" href="../dashboard_admin.php">
                <img src="assets/logo.png" alt="logo" width="100" height="50">
            </a>
        </ul>
        <ul class="navbar-nav ms-auto secondnav">
            <li class="nav-item">
                <a class="nav-link" href="account/accountindex.php">Account</a>
            </li>
            <li class="nav-item">
                    <button><a class="nav-link" href="logout.php">Logout</a></button>
            </li>
        </ul>
    </div>
    </nav>

    <hr class="hr-nav">
<div class="row">
    <div class="col-md text-center">
        <h1>Welkom op het SyntraPXL ADMIN portaal</h1>
        <p>Bij vragen/problemen kan je ons bereiken via <strong>test@test.com</strong></p>
    </div>
</div>
<hr>

<div class="row m-2">
    <div class="col-md text-center">
        <button class="bigbtn"><a href="students/student.php" class="nav-link">Cursist</a></button>
    </div>
    <div class="col-md text-center">
        <button class="bigbtn"><a href="courses/course.php" class="nav-link">Course</a></button>
    </div>

</div>
<div class="row m-2">
    <div class="col-md text-center">
        <button class="bigbtn"><a href="internships/internships_admin.php" class="nav-link">Stageplaatsen</a></button>
    </div>
</div>
<div class="row m-2">
    <div class="col-md text-center">
        <button class="bigbtn"><a href="teachers/teacher.php" class="nav-link">Docent</a></button>
    </div>
    <div class="col-md text-center">
        <button class="bigbtn"><a href="skills/skills.php" class="nav-link">Skills</a></button>
    </div>

</div>
</div>

<?php include('includes/footer.php'); ?>