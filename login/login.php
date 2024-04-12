<?php
session_start();
require_once '../db_connect.php'; // Include database connection
require_once 'hash_password.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Search for the user in the database using PDO
    try {
        $pdo = connectPDO();
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            // Admin found, store user data in session
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_type'] = 'admin';

            // Redirect admin to the admin dashboard
            header('Location: ../dashboard_admin.php');
            exit;
        } else {
            // Admin not found, search in teachers table
            $stmt = $pdo->prepare("SELECT * FROM teachers WHERE email = ?");
            $stmt->execute([$email]);
            $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($teacher && password_verify($password, $teacher['password'])) {
                // Teacher found, store user data in session
                $_SESSION['user_id'] = $teacher['id'];
                $_SESSION['user_type'] = 'teacher';

                // Redirect teacher to the teacher dashboard
                header('Location: ../dashboard_teacher.php');
                exit;
            } else {
                // User not found
                header('Location: login_fail.php');
                exit;
            }
        }
    } catch (Exception $e) {
        // Handle PDO connection error
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid input received
    header('Location: login_fail.php');
    exit;
}
?>
