<!DOCTYPE html>
<html lang="en">
<?php include_once "../db_connect.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include('../includes/bootstrap.php'); ?>
    <style>
        .top {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: red;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $response = array();
    $responseGrades = array();
    $gradeSoft = 0;
    $gradeHard = 0;
    $total = 0;
    $intHard = 0;
    $intSoft = 0;
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = $_SESSION['id'];

        $conn = connectDB();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

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

        $queryGrades = $conn->prepare("
            SELECT
                s.type AS type,
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
        // print_r($resultGrades);

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
            //  print_r($response);
            // echo $first_name;
        }
        if($resultGrades->num_rows > 0) {
            for($i = 0; $i < $resultGrades->num_rows; $i++) {
                $responseGrades[$i] = $resultGrades->fetch_assoc();
                $total += $responseGrades[$i]['grade'];
                if($responseGrades[$i]['type'] == 'hard') {
                    $gradeHard += $responseGrades[$i]['grade'];
                    $intHard++;
                } else {
                    $gradeSoft += $responseGrades[$i]['grade'];
                    $intSoft++;
                }
            }
            // print_r($responseGrades); 
        }
        // echo $response['contact_person_first_name'];
    }
    // echo $response['contact_person_first_name'];
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar bg-body-tertiary">
                    <button class="btn btn-outline-danger"><a href="student.php" class="nav-link">Terug</a></button>
                    <button class="btn btn-outline-danger" id="export-student-btn" onclick="exportStudent()">export</button>
                </nav>
            </div>
        </div>
        <form method="post" action="update_data.php">
            <div class="row">
                <div class="col-md-12">
                    <p><b><?php echo $response['contact_person_first_name'] . ' ' . $response['contact_person_last_name'] ?></b></p>
                    <p><?php echo $response['contact_person_email'] ?></p>
                    <p><?php echo $response['contact_person_phone'] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><b>Docent:</b></p>
                    <p><?php echo $response['teacher_first_name'] . ' ' . $response['teacher_last_name'] ?></p>
                    <p><b>Periode:</b></p>
                    <p><?php echo $response['internship_start_date'] . ' - ' . $response['internship_end_date'] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><b>Omgeving: <?php echo $response['company_name'] ?></b></p>
                    <textarea class="form-control" name="about" placeholder=""><?php echo !empty($response['about']) ? $response['about'] : '' ?></textarea>
                    <p><b>Scope</b></p>
                    <textarea class="form-control" name="scope" placeholder=""><?php echo !empty($response['scope']) ? $response['scope'] : '' ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><b>Evaluatie: (Hardskill/Softskill)</b></p>
                    <table class="table">
                        <?php 
                            for($i = 0; $i < $resultGrades->num_rows; $i++) {
                                // echo '<p>' . $responseGrades[$i]['skill_name'] . ': ' . $responseGrades[$i]['grade'] . '</p>';
                                echo "<tr><td><input type='text' class='form-control' value='" . $responseGrades[$i]['skill_name'] ." (". $responseGrades[$i]['type'] .  ")'></td><td colspan='2'><input type='number' min='0' max='10' class='form-control' name='grades[$i]' width='150px!important' value='" . $responseGrades[$i]['grade'] . "'></td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><b>Goede ervaringen en werkpunten: te bepalen door stagementor:</b></p>
                    <textarea class="form-control" name="feedback" placeholder=""><?php echo !empty($response['feedback']) ? $response['feedback'] : '' ?></textarea>
                    <p><b>Zou u deze stagair op basis van uw ervaringen aannemen in uw bedrijf</b></p>
                    <textarea class="form-control" name="employment" placeholder=""><?php echo !empty($response['employment']) ? $response['employment'] : '' ?></textarea>
                    
                    <?php 
                        $total = round($total/(10 * $resultGrades->num_rows)*100, 2);
                        $gradeHard = round($gradeHard / ($intHard > 0 ? (10 * $intHard) : 1) * 100, 2); // Avoid division by zero
                        $gradeSoft = round($gradeSoft / ($intSoft > 0 ? (10 * $intSoft) : 1) * 100, 2);
                    ?>
                    
                    <p><b>Totaal: <?php echo $total ?>%</b> veranderd niet tot deze data is opgeslagen</p>
                    <p>Softskill: <?php echo $gradeSoft ?>%, Hardskill: <?php echo $gradeHard ?>%</p>
                    <button type="submit" class="btn btn-outline-danger">Save</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    function exportStudent() {
        /* window.location.href = "export_student.php"; */
        window.open("export_student.php", '_blank');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>