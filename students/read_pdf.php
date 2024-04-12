<?php
require '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educational_center";
// error_log(print_r($_POST, true));
// print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["html_content"])) {
    // Get the HTML content from POST data
    $html = $_POST["html_content"];

    // Create a new instance of Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
    $dompdf = new Dompdf($options);

    // Load HTML content into DOMPDF
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream('sample.pdf');
} else {
    // If no HTML content is received via POST, return an error
    echo "Error: No HTML content received.";
}
?>
