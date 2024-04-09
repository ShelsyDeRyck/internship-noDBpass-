<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docent Dashboard</title>
    <link rel="stylesheet" href="styles/docent.css">
    
    <?php include ('bootstrap.php'); ?>
</head>
<body>
    <div class="container-fluid">
        <img src="assets/logo.png" alt="logo" class="logo">
        <nav>
            <div class="nav nav-underline">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">My Account</a>
                </li>
                <li class="nav-item">
                    <button><a class="nav-link" href="logout.php">Logout</a></button>
                </li>
                </ul>
            </div>
        </nav>
    </div>
    <hr>
    <div class="container">