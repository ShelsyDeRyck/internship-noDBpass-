<?php
// Include the Internship class and database configuration
require_once 'Internship.php';

// Create an instance of the Internship class
$internship = new Internship($pdo);

// Get the list of all internships for display
$internships = $internship->read();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internships</title>
<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Internships</h2>
    <table id="internshipsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Student</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internships as $i): ?>
            <tr>
                <td><?php echo htmlspecialchars($i['id']); ?></td>
                <td><?php echo htmlspecialchars($i['company_name']); // Change to display company name ?></td>
                <td><?php echo htmlspecialchars($i['address']); ?></td>
                <td><?php echo htmlspecialchars($i['contact_name']); // Change to display contact person name ?></td>
                <td><?php echo htmlspecialchars($i['student_name']); // Change to display student name ?></td>
                <td><?php echo htmlspecialchars($i['start_date']); ?></td>
                <td><?php echo htmlspecialchars($i['end_date']); ?></td>
                <td>
                    <button class="btn btn-primary btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
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
$(document).ready( function () {
    $('#internshipsTable').DataTable({
        // Add additional options here if needed
    });
});
</script>

</body>
</html>
