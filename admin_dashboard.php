<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stage2024</title>
    <link rel="stylesheet" href="styles/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <button><a class="nav-link" href="index.php">Logout</a></button>
                </li>
                </ul>
            </div>
        </nav>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md text-center">
                <h1>Welkom op het SyntraPXL ADMIN portaal</h1>
                <p>Bij vragen/problemen kan je ons bereiken via <strong>test@test.com</strong></p>
            </div>
        </div>
        <hr>
        <div class="row m-2">
            <div class="col-md text-center">
                <button class="bigbtn"><a href="admin.php" class="nav-link">Algemeen overzicht</a></button>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md text-center">
                <button class="bigbtn"><a href="admin.php" class="nav-link">Cursist</a></button>
            </div>
            <div class="col-md text-center">
                <button class="bigbtn"><a href="admin.php" class="nav-link">Course</a></button>
            </div>
            
        </div>
        <div class="row m-2">
            <div class="col-md text-center">
                <button class="bigbtn"><a href="admin.php" class="nav-link">Docent</a></button>
            </div>
            <div class="col-md text-center">
                <button class="bigbtn"><a href="admin.php" class="nav-link">Skills</a></button>
            </div>
            
        </div>
    </div>


    
</body>
</html>