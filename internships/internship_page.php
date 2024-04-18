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

//Create

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // We assume that the data from the form has already been checked and cleared of possible injections

    $companyName = $_POST['companyName'];
    $address = $_POST['address'];
    $contactFirstName = $_POST['contactFirstName'];
    $contactLastName = $_POST['contactLastName'];
    $contactEmail = $_POST['contactEmail'];
    $contactPhone = $_POST['contactPhone'];

    // Call a method to create a record in the database
    $result = $internship->create([
        'companyName' => $companyName,
        'address' => $address,
        'contactFirstName' => $contactFirstName,
        'contactLastName' => $contactLastName,
        'contactEmail' => $contactEmail,
        'contactPhone' => $contactPhone,
        
    ]);

    header('Content-Type: application/json');
    echo json_encode(['success' => $result]);
    exit;
}

//Update

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    $companyId = $_POST['companyId'];
    $companyData = [
        'companyName' => $_POST['companyName'],
        'address' => $_POST['address']
    ];
    $contactData = [
        'contactFirstName' => $_POST['contactFirstName'],
        'contactLastName' => $_POST['contactLastName'],
        'contactEmail' => $_POST['contactEmail'],
        'contactPhone' => $_POST['contactPhone']
    ];

    $updateCompanySuccess = $internship->updateCompany($companyId, $companyData);
    $updateContactSuccess = $internship->updateContactPerson($companyId, $contactData);

    // Optionally update internships table if needed
    // $newContactId = {determined somehow};
    // $updateInternshipSuccess = $internship->updateInternshipContact($companyId, $newContactId);

    header('Content-Type: application/json');
    echo json_encode([
        'success' => $updateCompanySuccess && $updateContactSuccess,
        'companyUpdated' => $updateCompanySuccess,
        'contactUpdated' => $updateContactSuccess
        // 'internshipUpdated' => $updateInternshipSuccess // Uncomment if updating internships
    ]);
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInternshipModal">
    Stageplaats Toevoegen
    </button>
    <table id="internshipsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Bedrijf</th>
                <th>Adres</th>
                <th>Contactpersoon</th>
                <th>Contacttelefoon</th>
                <th>Contact E-mail</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internships as $i): ?>
            <tr>
                <td><?php echo htmlspecialchars($i['name']); // Change to display company name ?></td>
                <td><?php echo htmlspecialchars($i['address']); ?></td>
                <td><?php echo htmlspecialchars($i['contact_name']); // Change to display contact person name ?></td>
                <td><?php echo htmlspecialchars($i['contact_phone']); ?></td>
                <td><?php echo htmlspecialchars($i['contact_email']); ?></td>
                <td>
                    <button class="btn btn-primary btn-sm edit-button" data-id="<?php echo htmlspecialchars($i['id']); ?>" data-company-id="<?php echo htmlspecialchars($i['company_id'] ?? ''); ?>">Bewerken</button>
                    <button class="btn btn-danger btn-sm delete-button" data-id="<?php echo htmlspecialchars($i['id']); ?>">Verwijderen</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Modal for Editing Internship -->
<div class="modal fade" id="editInternshipModal" tabindex="-1" aria-labelledby="editInternshipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInternshipModalLabel">Bewerk Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Sluiten"></button>
            </div>
            <div class="modal-body">
                <form id="editInternshipForm">
                    <input type="hidden" id="editInternshipId" name="id">
                    <!-- Добавляем скрытое поле для action -->
                    <input type="hidden" name="action" value="update">
                    <div class="mb-3">
                        <label for="editCompanyName" class="form-label">Bedrijfsnaam:</label>
                        <input type="text" class="form-control" id="editCompanyName" name="companyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Adres:</label>
                        <input type="text" class="form-control" id="editAddress" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContactFirstName" class="form-label">Voornaam Contactpersoon:</label>
                        <input type="text" class="form-control" id="editContactFirstName" name="contactFirstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContactLastName" class="form-label">Achternaam Contactpersoon:</label>
                        <input type="text" class="form-control" id="editContactLastName" name="contactLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContactEmail" class="form-label">Contact Email:</label>
                        <input type="email" class="form-control" id="editContactEmail" name="contactEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContactPhone" class="form-label">Contact Telefoon:</label>
                        <input type="tel" class="form-control" id="editContactPhone" name="contactPhone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating Internship -->
<div class="modal fade" id="createInternshipModal" tabindex="-1" aria-labelledby="createInternshipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInternshipModalLabel">Nieuwe Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Sluiten"></button>
            </div>
            <div class="modal-body">
                <form id="createInternshipForm">
                    <div class="mb-3">
                        <label for="companyName" class="form-label">Bedrijfsnaam:</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Adres:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactFirstName" class="form-label">Voornaam Contactpersoon:</label>
                        <input type="text" class="form-control" id="contactFirstName" name="contactFirstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactLastName" class="form-label">Achternaam Contactpersoon:</label>
                        <input type="text" class="form-control" id="contactLastName" name="contactLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactEmail" class="form-label">Contact Email:</label>
                        <input type="email" class="form-control" id="contactEmail" name="contactEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactPhone" class="form-label">Contact Telefoon:</label>
                        <input type="tel" class="form-control" id="contactPhone" name="contactPhone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
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
    var table = $('#internshipsTable').DataTable();

    // Click handler for the "Delete" button
    $('#internshipsTable tbody').on('click', 'button.delete-button', function() {
        var button = $(this);
        var internshipId = button.data('id');

        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: 'http://localhost/Stage2024/internships/internship_page.php',
                type: 'POST',
                dataType: 'json',  // Expect JSON response
                data: {
                    'id': internshipId,
                    'action': 'delete'
                },
                success: function(result) {
                    if (result.success) {
                        table.row(button.parents('tr')).remove().draw();
                        alert('Record deleted.');
                    } else {
                        alert('Failed to delete the record.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Error occurred while processing the request.');
                }
            });
        }
    });

// Click handler for the "Edit" button
$('#internshipsTable tbody').on('click', 'button.edit-button', function() {
    var button = $(this);
    var internshipId = button.data('id');
    var row = table.row(button.parents('tr')).data(); // Get data from the row

    // Splitting the contact person's name into first name and last name
    var contactNameParts = row[2].split(' '); // Assuming the name is in the format "First Last"
    var contactFirstName = contactNameParts[0];
    var contactLastName = contactNameParts.slice(1).join(' '); // Joining the last name parts if any

    // Fill the edit form with data from the selected row
    $('#editInternshipId').val(internshipId);
    $('#editCompanyName').val(row[0]);
    $('#editAddress').val(row[1]);
    $('#editContactFirstName').val(contactFirstName);
    $('#editContactLastName').val(contactLastName); // Now filling last name separately
    $('#editContactPhone').val(row[3]);
    $('#editContactEmail').val(row[4]);

    // Show the edit modal
    $('#editInternshipModal').modal('show');
});


/// Form submission handler for editing internships
$('#editInternshipForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var companyId = $(this).find('#editCompanyId').val(); // Assumes there is a field with the company ID in the form

    $.ajax({
        url: 'http://localhost/Stage2024/internships/internship_page.php',
        type: 'POST',
        data: formData + '&action=update', // formData already contains companyId
        success: function(data) {
            if (data.success) {
                alert('Internship Updated Successfully!');
                $('#editInternshipModal').modal('hide');
            } else {
                alert('Error updating internship: ' + data.error);
            }
        },
        error: function() {
            alert('Error updating internship. Please check the server and network.');
        }
    });
});

    // Form submission handler for creating internships
    $('#createInternshipForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: 'http://localhost/Stage2024/internships/internship_page.php', 
            type: 'POST',
            data: formData,
            success: function(data) {
                alert('Internship Created Successfully!');
                $('#createInternshipModal').modal('hide');
            },
            error: function() {
                alert('Error creating internship.');
                       }
        });
    });
});


</script>
</body>
</html>