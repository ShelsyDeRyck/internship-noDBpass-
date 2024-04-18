<?php
include_once "../db_connect.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $conn = connectDB();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update about and scope in the database
    $about = $_POST['about'];
    $scope = $_POST['scope'];
    $feedback = $_POST['feedback'];
    $employment = $_POST['employment'];


    $stmt = $conn->prepare("UPDATE internship_student SET about = ?, scope = ?, employment = ?, feedback = ? WHERE student_id = ?");
    $stmt->bind_param("ssssi", $about, $scope, $employment, $feedback, $id);

    if ($stmt->execute()) {
        echo "Data updated successfully!";
        header('Location: ./edit_form.php');
        exit;
    } else {
        echo "Error updating data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>