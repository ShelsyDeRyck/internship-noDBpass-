<?php include('includes/header_docent.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'teachers') {
    header('Location: index.php'); // Redirect to login page if not authorized
    exit;
} ?>

<div class="row">
    <div class="col-md text-center">
        <h1>Welkom op het SyntraPXL DOCENTEN portaal</h1>
        <p>Bij vragen/problemen kan je ons bereiken via <strong>test@test.com</strong></p>
    </div>
</div>
<hr>
<div class="row m-2">
    <div class="col-md text-center">
        <button class="bigbtn"><a href="internship.php" class="nav-link">Stageplaatsen</a></button>
    </div>

</div>
<div class="row m-2">
    <div class="col-md text-center">
        <button class="bigbtn"><a href="student.php" class="nav-link">Cursist</a></button>
    </div>
    <div class="col-md text-center">
        <button class="bigbtn"><a href="course.php" class="nav-link">Course</a></button>
    </div>

</div>

</div>

<?php include('includes/footer.php'); ?>