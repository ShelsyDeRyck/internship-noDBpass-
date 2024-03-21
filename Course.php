<?php
require_once 'db_config.php';

class Course {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $description, $duration, $location) {
        try {
            $sql = "INSERT INTO courses (name, description, duration, location) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $description, $duration, $location]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Log the error or handle it in some other way
            return false;
        }
    }

    public function read($course_id = null) {
        try {
            if ($course_id) {
                $sql = "SELECT * FROM courses WHERE course_id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$course_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM courses";
                $stmt = $this->pdo->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Log the error or handle it in some other way
            return false;
        }
    }

    public function update($course_id, $name, $description, $duration, $location) {
        try {
            $sql = "UPDATE courses SET name = ?, description = ?, duration = ?, location = ? WHERE course_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $description, $duration, $location, $course_id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log the error or handle it in some other way
            return false;
        }
    }

    public function deleteCourse($course_id) {
        try {
            $sql = "DELETE FROM courses WHERE course_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$course_id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log the error or handle it in some other way
            return false;
        }
    }
}

// Example usage
$course = new Course($pdo); // $pdo - your PDO object, connection to the database
?>
