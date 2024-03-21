<?php

class Grade {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Adding a grade for a student
    public function create($student_id, $course_id, $docent_id, $academic_year, $grade) {
        $sql = "INSERT INTO student_grades (student_id, course_id, docent_id, academic_year, grade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$student_id, $course_id, $docent_id, $academic_year, $grade])) {
            throw new Exception("Error adding grade.");
        }
    }

    // Getting information about grades
    public function read($grade_id = null) {
        if ($grade_id) {
            $sql = "SELECT * FROM student_grades WHERE grade_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$grade_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM student_grades";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Updating a grade
    public function update($grade_id, $student_id, $course_id, $docent_id, $academic_year, $grade) {
        $sql = "UPDATE student_grades SET student_id = ?, course_id = ?, docent_id = ?, academic_year = ?, grade = ? WHERE grade_id = ?";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$student_id, $course_id, $docent_id, $academic_year, $grade, $grade_id])) {
            throw new Exception("Error updating grade.");
        }
    }

    // Deleting a grade
    public function delete($grade_id) {
        $sql = "DELETE FROM student_grades WHERE grade_id = ?";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([$grade_id])) {
            throw new Exception("Error deleting grade.");
        }
    }
}
?>
