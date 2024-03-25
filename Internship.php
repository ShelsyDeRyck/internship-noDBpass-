<?php
require_once 'db_config.php';

class Internship {
    // Adding a new internship
    public function create($companyName, $address, $contactPerson, $start_date, $end_date, $student_id = null) {
        global $pdo;
        try {
            $sql = "INSERT INTO internships (company_name, address, contact_person, start_date, end_date, student_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$companyName, $address, $contactPerson, $start_date, $end_date, $student_id]);
            return true; // Returning true upon successful addition
        } catch (PDOException $e) {
            // Logging the error $e->getMessage();
            return false; // Returning false in case of an error
        }
    }

    // Getting information about internships
    public function read($internship_id = null) {
        global $pdo;
        try {
            if ($internship_id) {
                $sql = "SELECT * FROM internships WHERE internship_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$internship_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM internships";
                $stmt = $pdo->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Logging the error $e->getMessage();
            return false;
        }
    }

    // Updating internship information
    public function update($internship_id, $companyName, $address, $contactPerson, $start_date, $end_date, $student_id = null) {
        global $pdo;
        try {
            $sql = "UPDATE internships SET company_name = ?, address = ?, contact_person = ?, start_date = ?, end_date = ?, student_id = ? WHERE internship_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$companyName, $address, $contactPerson, $start_date, $end_date, $student_id, $internship_id]);
            return true;
        } catch (PDOException $e) {
            // Logging the error $e->getMessage();
            return false;
        }
    }

    // Deleting internship
    public function delete($internship_id) {
        global $pdo;
        try {
            $sql = "DELETE FROM internships WHERE internship_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$internship_id]);
            return true;
        } catch (PDOException $e) {
            // Logging the error $e->getMessage();
            return false;
        }
    }
}
?>
