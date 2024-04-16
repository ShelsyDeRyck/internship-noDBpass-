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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php include ('includes/bootstrap.php'); ?>
    <link rel="stylesheet" href="./styles/admin.css">
    

    
</head>

<body>
<nav class="navbar navbar-expand-lg mb-3">
    <div class="container-fluid">
        <ul class="navbar-nav firstnav">
            <a class="navbar-brand" href="../dashboard_admin.php">
                <img src="assets/logo.png" alt="logo" width="100" height="50">
            </a>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse justify-content-end id="navbarNav">
            <ul class="navbar-nav ms-auto secondnav">
                <li class="nav-item">
                    <a class="nav-link" href="account/accountindex.php">Account</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-outline-danger"><a class="nav-link btnLogout" href="logout.php">Logout</a></button>
                </li>
            </ul>
        </div>
        
    </div>
    
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md text-center">
                <h1>Welkom op het <strong>SyntraPXL ADMIN</strong> portaal</h1>
                <p>Bij vragen/problemen kan je ons bereiken via <strong>        test@test.com</strong></p>
            </div>
        </div>
        <hr style="color: black; width: 80%; margin-left: auto; margin-right: auto;">

        <div class="row m-2">
            <div class="col-md text-center">
                <button class="bigbtn"><a href="students/student.php" class="nav-link">Cursist</a></button>
                <button class="bigbtn"><a href="internships/internships_admin.php" class="nav-link">Stageplaatsen</a></button>
                <button class="bigbtn"><a href="courses/course.php" class="nav-link">Course</a></button>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md text-center">
                <button class="bigbtn"><a href="teachers/teacher.php" class="nav-link">Docent</a></button>
                <button class="bigbtn"><a href="skills/skills.php" class="nav-link">Skills</a></button>
            </div>
        </div>
    </div>


<?php include('includes/footer.php'); ?>