<?php
require '../vendor/autoload.php';
ob_end_clean();
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educational_center";

session_start();
// Controleer of de student-ID is ontvangen via POST
if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    // Ontvang de student-ID
    $id = $_SESSION['id'];

    // Maak een verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //column names -> students (table)
    //id, first_name, last_name, email, course_id, date_of_birth, study_year
    // $student_columns = array('id', 'first_name', 'last_name', 'email', 'course_id', 'date_of_birth', 'study_year');

    //student_course (table)
    //course_id, student_id
    // $student_course_columns = array('course_id', 'student_id');

    //student grades (table)
    //student_id, course_id, grade_id, teacher_id, grade, academic_year
    // $student_grades_columns = array('student_id', 'course_id', 'grade_id', 'teacher_id', 'grade', 'academic_year');

    //courses (table)
    //course_id, name, description
    // $courses_columns = array('course_id', 'name', 'description');

    //internship (table)
    //id, student_id, company_id, address, contact_person_id, start_date, end_date
    // $internship_columns = array('id', 'student_id', 'company_id', 'address', 'contact_person_id', 'start_date', 'end_date');

    //course (table)
    //course_id, name, description, duration, location
    // $course_columns = array('course_id', 'name', 'description', 'duration', 'location');
  
    $pdf = new \Dompdf\Dompdf(array('enable_remote'  =>  true));

    $query = $conn->prepare("
    SELECT 
        s.id AS student_id,
        s.first_name,
        s.last_name,
        s.email,
        s.date_of_birth,
        s.study_year,
        c.course_id AS student_course_id,
        c.name AS course_name,
        c.description AS course_description,
        sg.grade_id AS student_grade_id,
        sg.teacher_id,
        sg.grade,
        sg.academic_year,
        i.id AS internship_id,
        i.company_id,
        i.address AS internship_address,
        i.contact_person_id AS internship_contact_person_id,
        i.start_date AS internship_start_date,
        i.end_date AS internship_end_date
    FROM 
        students AS s
    LEFT JOIN 
        student_course AS sc ON s.id = sc.student_id
    LEFT JOIN 
        courses AS c ON sc.course_id = c.course_id
    LEFT JOIN 
        student_grades AS sg ON s.id = sg.student_id AND sc.course_id = sg.course_id
    LEFT JOIN 
        internship AS i ON s.id = i.student_id
    WHERE 
        s.id = ?
    ");
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
            $student_id = $response['student_id'];
            $first_name = $response['first_name'];
            $last_name = $response['last_name'];
            $email = $response['email'];
            $date_of_birth = $response['date_of_birth'];
            $study_year = $response['study_year'];
            $student_course_id = $response['student_course_id'];
            $course_name = $response['course_name'];
            $course_description = $response['course_description'];
            $student_grade_id = $response['student_grade_id'];
            $teacher_id = $response['teacher_id'];
            $grade = $response['grade'];
            $academic_year = $response['academic_year'];
            $internship_id = $response['internship_id'];
            $company_id = $response['company_id'];
            $internship_address = $response['internship_address'];
            $internship_contact_person_id = $response['internship_contact_person_id'];
            $internship_start_date = $response['internship_start_date'];
            $internship_end_date = $response['internship_end_date'];
        }
    }


    if ($result->num_rows > 0) {
        $html = "<h1>Student</h1>
        <h2>Student ID: $id</h2>
        <h3>Student name: $first_name $last_name</h3>";
    
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
    
        // Close and output PDF
        $filename = md5($id . '_student_information.pdf');
        $pdf->stream($filename, array("Attachment" => 0)); // 1 = download, 0 = preview
    }

    // Sluit de verbinding met de database
    $conn->close();
} else {
    // Geen student-ID ontvangen, geef een foutmelding terug
    echo "Geen student-ID ontvangen";
}
?>