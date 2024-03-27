<?php
require_once 'db_config.php';

class Student {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($firstName, $lastName, $email, $age, $studyYear) {
        $sql = "INSERT INTO cursisten (first_name, last_name, email, age, study_year) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $age, $studyYear]);
    }

    public function read($student_id = null) {
        if ($student_id) {
            $sql = "SELECT * FROM cursisten WHERE student_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$student_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM cursisten";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($student_id, $firstName, $lastName, $email, $age, $studyYear) {
        $sql = "UPDATE cursisten SET first_name = ?, last_name = ?, email = ?, age = ?, study_year = ? WHERE student_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $age, $studyYear, $student_id]);
    }

    public function delete($student_id) {
        $sql = "DELETE FROM cursisten WHERE student_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$student_id]);
    }
}
?>

<?php include ('navbar.php'); ?>
<?php include ('bootstrap.php'); ?>
<?php include ('footer.php'); ?>