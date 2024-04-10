<?php
require '../vendor/autoload.php';
ob_end_clean();
// Databaseverbinding maken
$servername = "localhost";
$username = "root";
$password = "root";
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
    
    $pdf = new \Dompdf\Dompdf(array('enable_remote'  =>  true));

    $query = $conn->prepare("
    SELECT 
        cp.first_name AS contact_person_first_name,
        cp.last_name AS contact_person_last_name,
        cp.email AS contact_person_email,
        cp.phone AS contact_person_phone,
        t.first_name AS teacher_first_name,
        t.last_name AS teacher_last_name,
        i.start_date AS internship_start_date,
        i.end_date AS internship_end_date,
        c.name AS company_name
    FROM 
        students s
    LEFT JOIN 
        internships i ON s.id = i.student_id
    LEFT JOIN 
        contact_person cp ON i.contact_person_id = cp.id
    LEFT JOIN 
        course_teacher ct ON s.course_id = ct.course_id
    LEFT JOIN 
        teachers t ON ct.teacher_id = t.id
    LEFT JOIN
        companies c ON i.company_id = c.id
    WHERE 
        s.id = ?; 
    ");

    // sk.name AS skill_name,
    // sk.type AS skill_type,
    // sg.grade AS student_grade

    // LEFT JOIN
    //     skills sk ON ss.skill_id = sk.id
    // LEFT JOIN
    //     student_grades sg ON s.id = sg.student_id

    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
        $first_name = $response['contact_person_first_name'];
        $last_name = $response['contact_person_last_name'];
        $email = $response['contact_person_email'];
        $phone = $response['contact_person_phone'];
        $date = $response['internship_start_date'] . ' - ' . $response['internship_end_date'];
        // print_r($response);

        $html = "
            <p><b>$first_name $last_name</b></p>
            <p>$email</p>
            <p>$phone</p>

            <p><b>Docent</b></p>
            <p>$response[teacher_first_name] $response[teacher_last_name]</p>

            <p><b>Periode</b></p>
            <p>$date</p>

            <p><b>Omgeving: $response[company_name]</b></p>
            <textarea></textarea>

            <p><b>Scope</b></p>
            <textarea></textarea>

            <p><b>Evaluatie: (Hardskill/Softskill)</b></p>
            
            <p><b>Goede ervaringen en werkpunten: te bepalen door stagementor:</b></p>
            <textarea></textarea>

            <p><b>Zou u deze stagair op basis van uw ervaringen aannemen in uw bedrijf</b></p>
            <textarea></textarea>

            <p><b>Totaal:</b></p>
            <p>Softskill: %, Hardskill: %</p>
        ";
    
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