<?php
require '../vendor/autoload.php';
ob_end_clean();
// Databaseverbinding maken
include_once "../db_connect.php";

session_start();
// Controleer of de student-ID is ontvangen via POST
if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    // Ontvang de student-ID
    $id = $_SESSION['id'];

    // Maak een verbinding met de database
    $conn = connectDB();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $pdf = new \Dompdf\Dompdf(array('enable_remote'  =>  true));

    $query = $conn->prepare("
        SELECT
            s.first_name AS student_first_name,
            s.last_name AS student_last_name,
            c.name AS course_name,
            t.first_name AS teacher_first_name,
            t.last_name AS teacher_last_name,
            ist.start_date AS internship_start_date,
            ist.end_date AS internship_end_date,
            ist.scope AS scope,
            ist.about AS about,
            ist.feedback AS feedback,
            ist.employment AS employment,
            sk.name AS skill_name,
            ss.grade AS grade,
            cp.first_name AS contact_person_first_name,
            cp.last_name AS contact_person_last_name,
            cp.email AS contact_person_email,
            cp.phone AS contact_person_phone,
            co.name AS company_name
        FROM
            students s
        LEFT JOIN internship_student ist ON s.id = ist.student_id 
        LEFT JOIN student_course sc ON s.id = sc.student_id
        LEFT JOIN courses c ON sc.course_id = c.id
        LEFT JOIN course_teacher ct ON c.id = ct.course_id
        LEFT JOIN course_skill cs ON c.id = cs.course_id
        LEFT JOIN teachers t ON ct.teacher_id = t.id
        LEFT JOIN skill_student ss ON ist.student_id = ss.student_id
        LEFT JOIN skills sk ON ss.skill_id = sk.id
        LEFT JOIN internships i ON ist.internship_id = i.id
        LEFT JOIN contact_person cp ON i.contact_person_id = cp.id
        LEFT JOIN companies co ON i.company_id = co.id
        WHERE
            s.id = ?;
        ");
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();

    
    $gradeSoft = 0;
    $gradeHard = 0;
    $total = 0;
    $intHard = 0;
    $intSoft = 0;

    $queryGrades = $conn->prepare("
            SELECT
                s.name AS skill_name,
                ss.grade AS grade
            FROM
                skill_student ss
            LEFT JOIN skills s ON ss.skill_id = s.id
            WHERE
                ss.student_id = ?;
        ");
    $queryGrades->bind_param('i', $id);
    $queryGrades->execute();
    $resultGrades = $queryGrades->get_result();
    if ($resultGrades->num_rows > 0) {
        for($i = 0; $i < $resultGrades->num_rows; $i++) {
            $responseGrades[$i] = $resultGrades->fetch_assoc();
            $total += $responseGrades[$i]['grade'];
            if($responseGrades[$i]['type'] == 'H') {
                $gradeHard += $responseGrades[$i]['grade'];
                $intHard++;
            } else {
                $gradeSoft += $responseGrades[$i]['grade'];
                $intSoft++;
            }
        }
        
    }


    // print_r($responseGrades);

    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
        // print_r($response);

        $html = "
            <p><b>{$response['contact_person_first_name']} {$response['contact_person_last_name']}</b></p>
            <p>{$response['contact_person_email']}</p>
            <p>{$response['contact_person_phone']}</p>

            <p><b>Docent</b></p>
            <p>{$response['teacher_first_name']} {$response['teacher_last_name']}</p>

            <p><b>Periode</b></p>
            <p>{$response['internship_start_date']} {$response['internship_end_date']}</p>

            <p><b>Omgeving: {$response['company_name']}</b></p>
            <textarea class='form-control'>{$response['about']}</textarea>

            <p><b>Scope</b></p>
            <textarea class='form-control'>{$response['scope']}</textarea>

            <p><b>Evaluatie: (Hardskill/Softskill)</b></p>
            <table class='table'>
        ";


        for($i = 0; $i < $resultGrades->num_rows; $i++) {
            // echo '<p>' . $responseGrades[$i]['skill_name'] . ': ' . $responseGrades[$i]['grade'] . '</p>';
            $html .= "<tr><td>{$responseGrades[$i]['skill_name']}</td><td>{$responseGrades[$i]['grade']}</td></tr>";
        }

        $total = round($total/(10 * $resultGrades->num_rows)*100, 2);
        $gradeHard = round($gradeHard / (10 * $intHard) * 100, 2);
        $gradeSoft = round($gradeSoft / (10 * $intSoft) * 100, 2);
     

        $html .= "
                    </table>
                    <p><b>Goede ervaringen en werkpunten: te bepalen door stagementor:</b></p>
                    <textarea class='form-control'>{$response['feedback']}</textarea>
                
                    <p><b>Zou u deze stagair op basis van uw ervaringen aannemen in uw bedrijf</b></p>
                    <textarea class='form-control'>{$response['employment']}</textarea>
                
                    <p><b>Totaal: {$total} %</b></p>
                    <p>Softskill:{$gradeSoft} %, Hardskill: {$gradeHard} %</p>
        ";
    
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
    
        // Close and output PDF
        $filename = md5($response['student_first_name'].'_'. $response['student_last_name'] . '_internship.pdf');
        $pdf->stream($filename, array("Attachment" => 0)); // 1 = download, 0 = preview
    }

    // Sluit de verbinding met de database
    $conn->close();
} else {
    // Geen student-ID ontvangen, geef een foutmelding terug
    echo "Geen student-ID ontvangen";
}
?>