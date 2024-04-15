<?php
require_once '../db_config.php';

class Internship {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }
    
public function create($formData) {
    try {
        $this->db->beginTransaction();

        // Insert into companies table
        $companySql = "INSERT INTO companies (name, address) VALUES (?, ?)";
        $companyStmt = $this->db->prepare($companySql);
        $companyStmt->execute([$formData['companyName'], $formData['address']]);
        $companyId = $this->db->lastInsertId(); // Get ID of the new company

        // Insert into contact_person table
        $contactSql = "INSERT INTO contact_person (first_name, last_name, email, phone, company_id) VALUES (?, ?, ?, ?, ?)";
        $contactStmt = $this->db->prepare($contactSql);
        $contactStmt->execute([$formData['contactFirstName'], $formData['contactLastName'], $formData['contactEmail'], $formData['contactPhone'], $companyId]);
        $contactPersonId = $this->db->lastInsertId(); // Get ID of the new contact person

        // Insert into internships table
        $internshipSql = "INSERT INTO internships (company_id, contact_person_id) VALUES (?, ?)";
        $internshipStmt = $this->db->prepare($internshipSql);
        $internshipStmt->execute([$companyId, $contactPersonId]);

        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        $this->db->rollBack();
        // Error handling should be here
        return false;
    }
}

public function read($company_id = null) {
    try {
        if ($company_id) {
            // If information about a specific company is needed
            $sql = "SELECT c.*, CONCAT(cp.first_name, ' ', cp.last_name) AS contact_name, cp.phone AS contact_phone, cp.email AS contact_email
                    FROM companies c
                    INNER JOIN contact_person cp ON c.id = cp.company_id
                    WHERE c.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$company_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            // If a list of all companies is needed
            $sql = "SELECT c.*, CONCAT(cp.first_name, ' ', cp.last_name) AS contact_name, cp.phone AS contact_phone, cp.email AS contact_email
                    FROM companies c
                    INNER JOIN contact_person cp ON c.id = cp.company_id";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Error handling should be here
        return false;
    }
}

// Updating information using company_id
public function updateByCompanyId($companyId, $data) {
    try {
        $sql = "UPDATE companies c
                INNER JOIN contact_person cp ON cp.company_id = c.id
                INNER JOIN internships i ON i.contact_person_id = cp.id
                SET c.name = :companyName,
                    c.address = :address,
                    cp.first_name = :contactFirstName,
                    cp.last_name = :contactLastName,
                    cp.email = :contactEmail,
                    cp.phone = :contactPhone
                WHERE c.id = :companyId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':companyName', $data['companyName'], PDO::PARAM_STR);
        $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
        $stmt->bindParam(':contactFirstName', $data['contactFirstName'], PDO::PARAM_STR);
        $stmt->bindParam(':contactLastName', $data['contactLastName'], PDO::PARAM_STR);
        $stmt->bindParam(':contactEmail', $data['contactEmail'], PDO::PARAM_STR);
        $stmt->bindParam(':contactPhone', $data['contactPhone'], PDO::PARAM_STR);
        $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Error handling should be implemented here
        return false;
    }
}


// Deleting internship, along with associated records in companies and contact_person tables
public function delete($internship_id) {
    try {
        $this->db->beginTransaction();
        
        // Find company ID associated with internship
        $sql_company_id = "SELECT company_id FROM internships WHERE id = ?";
        $stmt_company_id = $this->db->prepare($sql_company_id);
        $stmt_company_id->execute([$internship_id]);
        $company_id = $stmt_company_id->fetchColumn();

        // Find contact_person ID associated with internship
        $sql_contact_id = "SELECT contact_person_id FROM internships WHERE id = ?";
        $stmt_contact_id = $this->db->prepare($sql_contact_id);
        $stmt_contact_id->execute([$internship_id]);
        $contact_id = $stmt_contact_id->fetchColumn();

        // Delete record from internships table
        $sql_internship = "DELETE FROM internships WHERE id = ?";
        $stmt_internship = $this->db->prepare($sql_internship);
        $stmt_internship->execute([$internship_id]);

        // Delete associated record from companies table
        $sql_company = "DELETE FROM companies WHERE id = ?";
        $stmt_company = $this->db->prepare($sql_company);
        $stmt_company->execute([$company_id]);

        // Delete associated record from contact_person table
        $sql_contact = "DELETE FROM contact_person WHERE id = ?";
        $stmt_contact = $this->db->prepare($sql_contact);
        $stmt_contact->execute([$contact_id]);

        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        $this->db->rollBack();
        // Ideally, log the error
        return false;
    }
}

}

$internship = new Internship($pdo);
