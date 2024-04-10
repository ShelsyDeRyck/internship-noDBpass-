<?php
    session_start();

    $studentId = $_POST['id'];
    
    $_SESSION['id'] = $studentId;
    
    echo json_encode(['success' => true]);
?>