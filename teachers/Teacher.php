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
                <th>ID</th>
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
        <!-- Modal content -->
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
        <!-- Modal content -->
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
            { data: "id" },
            { data: "first_name" },
            { data: "last_name" },
            { data: "email" },
            { data: "password" },
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

    // Handle update teacher button click
    $('#update-teacher-btn').on('click', function() {
        var id = $('#edit-teacher-id').val();
        var firstName = $('#edit-first-name').val();
        var lastName = $('#edit-last-name').val();
        var email = $('#edit-email').val();
        var password = $('#edit-password').val();

        $.ajax({
            url: 'update_teacher.php',
            method: 'POST',
            data: { id: id, first_name: firstName, last_name: lastName, email: email, password: password },
            success: function(response) {
                $('#edit-teacher-modal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error updating teacher:", error);
            }
        });
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
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting teacher:", error);
                }
            });
        } else {
            console.error("No data found for the row.");
        }
    });

    // Handle add teacher button click
    $('#add-teacher-btn').on('click', function() {
        var firstName = $('#add-first-name').val();
        var lastName = $('#add-last-name').val();
        var email = $('#add-email').val();
        var password = $('#add-password').val();

        $.ajax({
            url: 'add_teacher.php',
            method: 'POST',
            data: { first_name: firstName, last_name: lastName, email: email, password: password },
            success: function(response) {
                $('#add-teacher-modal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error adding teacher:", error);
            }
        });
    });
});
</script>

<?php include('../includes/footer.php'); ?>
</body>
</html>
