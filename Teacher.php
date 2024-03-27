<?php

class Teacher {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Adding a new teacher
    public function create($firstName, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
        $sql = "INSERT INTO teachers (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$firstName, $lastName, $email, $hashedPassword])) {
            throw new Exception("Error adding teacher.");
        }
    }

    // Getting information about the teacher(s)
    public function read($teacher_id = null) {
        if ($teacher_id) {
            $sql = "SELECT teacher_id, first_name, last_name, email FROM teachers WHERE teacher_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$teacher_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT teacher_id, first_name, last_name, email FROM teachers";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating teacher information
    public function update($teacher_id, $firstName, $lastName, $email, $password = null) {
        $sql = "UPDATE teachers SET first_name = ?, last_name = ?, email = ?" . ($password ? ", password = ?" : "") . " WHERE teacher_id = ?";
        $params = [$firstName, $lastName, $email];
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params[] = $hashedPassword;
        }
        $params[] = $teacher_id;
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute($params)) {
            throw new Exception("Error updating teacher information.");
        }
    }

    // Deleting a teacher
    public function delete($teacher_id) {
        $sql = "DELETE FROM teachers WHERE teacher_id = ?";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$teacher_id])) {
            throw new Exception("Error deleting teacher.");
        }
    }
}
?>

<?php include ('navbar.php'); ?>
<?php include ('footer.php'); ?>