<?php
// Include the Internship class and database configuration
require_once 'Internship.php';

// Create an instance of the Internship class
$internship = new Internship($pdo);

// Check if there is a POST request to delete an internship
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $internship_id = $_POST['id'];
    $success = $internship->delete($internship_id);
    
    // Send a JSON response back to the AJAX call
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}

// Get the list of all internships for display
$internships = $internship->read();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stageplaats</title>
<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>
<body>
<?php include('../includes/navbar_admin.php'); ?>
<div class="container mt-5">
    <h2>Stageplaats</h2>
    <table id="internshipsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bedrijf</th>
                <th>Adres</th>
                <th>Contactpersoon</th>
                <th>Contacttelefoon</th>
                <th>Contact E-mail</th>
                <th>Student</th>
                <th>Startdatum</th>
                <th>Einddatum</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internships as $i): ?>
            <tr>
                <td><?php echo htmlspecialchars($i['id']); ?></td>
                <td><?php echo htmlspecialchars($i['company_name']); // Change to display company name ?></td>
                <td><?php echo htmlspecialchars($i['address']); ?></td>
                <td><?php echo htmlspecialchars($i['contact_name']); // Change to display contact person name ?></td>
                <td><?php echo htmlspecialchars($i['contact_phone']); ?></td>
                <td><?php echo htmlspecialchars($i['contact_email']); ?></td>
                <td><?php echo htmlspecialchars($i['student_name']); // Change to display student name ?></td>
                <td><?php echo htmlspecialchars($i['start_date']); ?></td>
                <td><?php echo htmlspecialchars($i['end_date']); ?></td>
                <td>
                    <button class="btn btn-primary btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm delete-button" data-id="<?php echo htmlspecialchars($i['id']); ?>">Delete</button>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#internshipsTable').DataTable({
        // Additional settings can be added here
    });

    $('#internshipsTable tbody').on('click', 'button.delete-button', function() {
        var button = $(this);
        var internshipId = button.data('id');

        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: 'http://localhost/Stage2024/internships.php', // Make sure this path is correct
                type: 'POST',
                dataType: 'json', // Expecting a JSON response
                data: {
                    'id': internshipId,
                    'action': 'delete'
                },
                success: function(result) {
                    // No need to parse result because dataType is 'json'
                    if (result.success) {
                        // Remove the row from DataTables
                        table.row(button.parents('tr')).remove().draw();
                        alert('Record deleted.');
                    } else {
                        alert('Failed to delete the record.');
                    }
                },
                error: function(xhr, status, error) {
                    // Log the error so you can see it in the console
                    console.error(error);
                    alert('Error occurred while processing the request.');
                }
            });
        }
    });
});

</script>
</body>
</html>
