<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage2024</title>
    <link rel="stylesheet" href="styles/index.css">
    <?php include('bootstrap.php'); ?>
</head>
<body>
<div class="container-fluid">

<h1><img src="assets/logo.png" alt="logo" class="logo"></h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md m-2 text-center">
                <h2>WELKOM BIJ SYNTRA PXL STAGE MANAGEMENT</h2>
                <p>Gelieve eerst in te loggen.</p>
            </div>
            <div class="col-md">
                <form method="post" action="login.php">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="text" id="email" name="email">
                    <label class="form-label" for="password">Password:</label>
                    <input class="form-control" type="password" id="password" name="password">
                    <input class="form-control btn btn-primary mt-3" type="submit" value="Login">
                </form>
            
            </div>
        </div>
           
    </div>
</div>

<?php include('footer.php'); ?>