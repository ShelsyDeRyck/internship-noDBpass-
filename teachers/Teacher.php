<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <?php include('../includes/navbar_admin.php'); ?>
    <div class="container mt-5">
        <h2>Teachers</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add-teacher-modal">Add Teacher</button>
        <table id="teachersTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically through JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- Bootstrap Modal for Edit Teacher -->
    <div id="edit-teacher-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Teacher</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-teacher-form">
                        <input type="hidden" id="edit-teacher-id">
                        <div class="form-group">
                            <label for="edit-first-name">First Name:</label>
                            <input type="text" class="form-control" id="edit-first-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-last-name">Last Name:</label>
                            <input type="text" class="form-control" id="edit-last-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" id="edit-email">
                        </div>
                        <div class="form-group">
                            <label for="edit-password">Password:</label>
                            <input type="password" class="form-control" id="edit-password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="update-teacher-btn">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal for Add Teacher -->
    <div id="add-teacher-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Teacher</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-teacher-form">
                        <div class="form-group">
                            <label for="add-first-name">First Name:</label>
                            <input type="text" class="form-control" id="add-first-name">
                        </div>
                        <div class="form-group">
                            <label for="add-last-name">Last Name:</label>
                            <input type="text" class="form-control" id="add-last-name">
                        </div>
                        <div class="form-group">
                            <label for="add-email">Email:</label>
                            <input type="email" class="form-control" id="add-email">
                        </div>
                        <div class="form-group">
                            <label for="add-password">Password:</label>
                            <input type="password" class="form-control" id="add-password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-teacher-btn">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            var table = $('#teachersTable').DataTable({
                ajax: {
                    url: "get_teachers.php", // Endpoint to fetch teachers data
                    dataSrc: ""
                },
                columns: [
                    { data: "id", visible: false }, // Hide ID column
                    { data: "first_name" },
                    { data: "last_name" },
                    { data: "email" },
                    { 
                        data: "password", 
                        render: function(data, type, row) {
                            return '<span class="password-text">********</span><button class="btn btn-link reveal-password" data-password="' + data + '">Reveal</button>';
                        }
                    },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm edit-btn">Edit</button>' +
                                '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ]
            });

            // Handle edit button click
            $('#teachersTable tbody').on('click', '.edit-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-teacher-id').val(rowData.id);
                    $('#edit-first-name').val(rowData.first_name);
                    $('#edit-last-name').val(rowData.last_name);
                    $('#edit-email').val(rowData.email);
                    $('#edit-password').val(rowData.password);
                    $('#edit-teacher-modal').modal('show');
                } else {
                    console.error("No data found for the row.");
                }
            });

          // Behandel klik op bijwerken leraar knop
$('#update-teacher-btn').on('click', function() {
    var id = $('#edit-teacher-id').val();
    var firstName = $('#edit-first-name').val();
    var lastName = $('#edit-last-name').val();
    var email = $('#edit-email').val();
    var password = $('#edit-password').val();

    // Controleer of alle velden leeg zijn
    if (firstName.trim() === '' && lastName.trim() === '' && email.trim() === '' && password.trim() === '') {
        showToast("Gelieve alle velden in te vullen");
    } else if (firstName.trim() === '') {
        showToast("Gelieve de voornaam van de leraar in te vullen");
    } else if (lastName.trim() === '') {
        showToast("Gelieve de achternaam van de leraar in te vullen");
    } else if (email.trim() === '') {
        showToast("Gelieve het e-mailadres van de leraar in te vullen");
    } else if (password.trim() === '') {
        showToast("Gelieve het wachtwoord van de leraar in te vullen");
    } else {
        // Als alle velden zijn ingevuld, voer AJAX-verzoek uit
        $.ajax({
            url: 'update_teacher.php',
            method: 'POST',
            data: { id: id, first_name: firstName, last_name: lastName, email: email, password: password },
            success: function(response) {
                $('#edit-teacher-modal').modal('hide');
                table.ajax.reload();
                showToast("Leraar succesvol bijgewerkt.");
            },
            error: function(xhr, status, error) {
                console.error("Fout bij bijwerken leraar:", error);
            }
        });
    }
});

            // Handle delete button click
            $('#teachersTable tbody').on('click', '.delete-btn', function() {
    var teacherId = $(this).data('id');
    if (teacherId) {
        $.ajax({
            url: 'delete_teacher.php',
            method: 'POST',
            data: { id: teacherId },
            success: function(response) {
                table.ajax.reload();
                showToast("Teacher is successfully deleted");
            },
            error: function(xhr, status, error) {
                console.error("Error deleting teacher:", error);
            }
        });
    } else {
        console.error("No data found for the row.");
    }
});

function showToast(message) {
    $('.toast-body').text(message);
    $('.toast').toast('show');
}


$('#add-teacher-btn').on('click', function() {
    var firstName = $('#add-first-name').val();
    var lastName = $('#add-last-name').val();
    var email = $('#add-email').val();
    var password = $('#add-password').val();

    if(firstName.trim() === '' && lastName.trim() === '' && email.trim() === '' && password.trim() === '') {
        // Als alle velden leeg zijn
        showToast('Gelieve alle velden in te vullen');
    } else if(firstName.trim() === '') {
        // Als voornaam ontbreekt
        showToast('Gelieve een voornaam in te vullen');
    } else if(lastName.trim() === '') {
        // Als achternaam ontbreekt
        showToast('Gelieve een achternaam in te vullen');
    } else if(email.trim() === '') {
        // Als e-mail ontbreekt
        showToast('Gelieve een e-mailadres in te vullen');
    } else if(password.trim() === '') {
        // Als wachtwoord ontbreekt
        showToast('Gelieve een wachtwoord in te vullen');
    } else {
        // Alle velden zijn ingevuld, voer AJAX-verzoek uit om leraar toe te voegen
        $.ajax({
            url: 'add_teacher.php',
            method: 'POST',
            data: { first_name: firstName, last_name: lastName, email: email, password: password },
            success: function(response) {
                $('#add-teacher-modal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Fout bij toevoegen leraar:", error);
            }
        });
    }

    function showToast(message) {
    $('.toast-body').text(message);
    $('.toast').toast('show');
}
});

            // Function to reveal/hide password
            $('#teachersTable tbody').on('click', '.reveal-password', function() {
                var password = $(this).data('password');
                var passwordText = $(this).siblings('.password-text');
                var buttonText = $(this);

                if (passwordText.text() === '********') {
                    passwordText.text(password);
                    buttonText.text('Hide');
                } else {
                    passwordText.text('********');
                    buttonText.text('Reveal');
                }
            });
        });
    </script>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
