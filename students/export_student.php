<?php
require '../vendor/autoload.php';
ob_end_clean();
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educational_center";

// Controleer of de student-ID is ontvangen via POST
if(isset($_POST['id'])) {
    // Ontvang de student-ID
    $id = $_POST['id'];

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
  
    $query = $conn->prepare(`
    SELECT 
        s.first_name,
        s.last_name,
        s.email,
        s.date_of_birth,
        s.study_year,
        sc.course_id,
        sg.grade_id,
        sg.teacher_id,
        sg.grade,
        sg.academic_year
    FROM 
        students AS s
    LEFT JOIN 
        student_course AS sc ON s.id = sc.student_id
    LEFT JOIN 
        student_grades AS sg ON s.id = sg.student_id
    WHERE 
        s.id = :student_id
    `);
    $query->bindParam(':student_id', $id);
    $query->execute();

    print_r($query);
    
    // Check if there are courses
    if ($query->rowCount() > 0) {

        $html = "<h1>Student</h1>
        <h2>Student ID: $id</h2>
        <h3>Student name: $first_name $last_name</h3>";

        $pdf->loadHtml(response);
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