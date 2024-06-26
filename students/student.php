<?php
session_start();

// Check if the user is logged in and has a user type set in the session
if (isset($_SESSION['user_type'])) {
    // Include the navbar based on the user type
    if ($_SESSION['user_type'] === 'admins') {
        include('../includes/navbar_admin.php');
    } elseif ($_SESSION['user_type'] === 'teachers') {
        include('../includes/navbar_docent.php');
    }
} else {
    // If user is not logged in, redirect to login page
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../styles/student.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Cursisten</h2>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#add-student-modal"><i class="bi bi-plus-square m-2"></i>Cursist Toevoegen</button>
        <table id="studentsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Geboortedatum</th>
                    <th>Studiejaar</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically through JavaScript -->
            </tbody>
        </table>
    </div>


    <!-- Bootstrap Modal for Edit Student -->
    <div id="edit-student-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cursist Bewerken</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-student-form">
                        <input type="hidden" id="edit-student-id">
                        <div class="form-group">
                            <label for="edit-first-name">Voornaam:</label>
                            <input type="text" class="form-control" id="edit-first-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-last-name">Achternaam:</label>
                            <input type="text" class="form-control" id="edit-last-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" id="edit-email">
                        </div>
                        <div class="form-group">
                            <label for="edit-date_of_birth">Geboortedatum:</label>
                            <input type="date" class="form-control" id="edit-date_of_birth">
                        </div>
                        <div class="form-group">
                            <label for="edit-study-year">Studiejaar:</label>
                            <input type="text" class="form-control" id="edit-study-year">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="update-student-btn">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal for Add Student -->
    <div id="add-student-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nieuwe Cursist Toevoegen</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-student-form">
                        <div class="form-group">
                            <label class="form-label" for="add-first-name">Voornaam:</label>
                            <input type="text" class="form-control" id="add-first-name">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-last-name">Achternaam:</label>
                            <input type="text" class="form-control" id="add-last-name">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-email">Email:</label>
                            <input type="email" class="form-control" id="add-email">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-date_of_birth">Geboortedatum:</label>
                            <input type="date" class="form-control" id="add-date_of_birth">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-study-year">Studiejaar:</label>
                            <input type="text" class="form-control" id="add-study-year">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="add-student-btn">Toevoegen</button>
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
            var table = $('#studentsTable').DataTable({
                ajax: {
                    url: "get_students.php", // Endpoint to fetch students data
                    dataSrc: ""
                },
                columns: [{
                        data: "id",
                        visible: false
                    }, // Hide ID column
                    {
                        data: "first_name"
                    },
                    {
                        data: "last_name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "date_of_birth"
                    },
                    {
                        data: "study_year"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class=" btn btn-secondary btn-sm edit-form-btn m-2" data-id="' + row.id + '">Stage Rapport</button>' +
                                '<button class="btn btn-primary btn-sm edit-btn m-1"><i class="bi bi-pencil-square"></i></button>' +
                                '<button class="btn btn-danger btn-sm delete-btn m-1" data-id="' + row.id + '"><i class="bi bi-trash3"></i></button>';
                        }
                    }
                ]
            });

            $('#add-student-btn').on('click', function() {
                $('#add-student-modal').show();
            });

            // Behandel klik op toevoegen student knop
            $('#submit-student-btn').on('click', function() {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var date_of_birth = $('#date_of_birth').val();
                var study_year = $('#study_year').val();

                $.ajax({
                    url: 'add_student.php',
                    method: 'POST',
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        email: email,
                        date_of_birth: date_of_birth,
                        study_year: study_year
                    },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-student-modal').hide();
                    }
                });
            });

            // Behandel klik op edit student knop
            $('#studentsTable tbody').on('click', '.edit-student-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-student-id').val(rowData.id);
                    $('#edit-first-name').val(rowData.first_name);
                    $('#edit-last-name').val(rowData.last_name);
                    $('#edit-email').val(rowData.email);
                    $('#edit-date_of_birth').val(rowData.date_of_birth);
                    $('#edit-study-year').val(rowData.study_year);
                    $('#edit-student-modal').modal('show');
                } else {
                    console.error("No data found for the row.");
                }
            });

            // Handle update student button click
            $('#update-student-btn').on('click', function() {
                var id = $('#edit-student-id').val();
                var firstName = $('#edit-first-name').val();
                var lastName = $('#edit-last-name').val();
                var email = $('#edit-email').val();
                var date_of_birth = $('#edit-date_of_birth').val();
                var studyYear = $('#edit-study-year').val();

                $.ajax({
                    url: 'update_student.php',
                    method: 'POST',
                    data: {
                        id: id,
                        first_name: firstName,
                        last_name: lastName,
                        email: email,
                        date_of_birth: date_of_birth,
                        study_year: studyYear
                    },
                    success: function(response) {
                        $('#edit-student-modal').modal('hide');
                        table.ajax.reload();
                        showToast("Student succesvol bijgewerkt.");
                    },
                    error: function(xhr, status, error) {
                        console.error("Fout bij bijwerken student:", error);
                    }
                });

            });


            // Handle delete button click
            $('#studentsTable tbody').on('click', '.delete-btn', function() {
                var studentId = $(this).data('id');
                if (studentId) {
                    $.ajax({
                        url: 'delete_student.php',
                        method: 'POST',
                        data: {
                            id: studentId
                        },
                        success: function(response) {
                            // Reload the table data
                            table.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error deleting student:", error);
                        }
                    });
                } else {
                    console.error("No data found for the row.");
                }
            });


            // Handle add student button click
            $('#add-student-btn').on('click', function() {
                var firstName = $('#add-first-name').val();
                var lastName = $('#add-last-name').val();
                var email = $('#add-email').val();
                var date_of_birth = $('#add-date_of_birth').val();
                var studyYear = $('#add-study-year').val();

                $.ajax({
                    url: 'add_student.php',
                    method: 'POST',
                    data: {
                        first_name: firstName,
                        last_name: lastName,
                        email: email,
                        date_of_birth: date_of_birth,
                        study_year: studyYear
                    },
                    success: function(response) {
                        $('#add-student-modal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding student:", error);
                    }
                });
            });
            //edit student form

            $('#studentsTable tbody').on('click', '.edit-form-btn', function() {
                let studentId = $(this).data('id');
                console.log(studentId);
                if (studentId) {


                    $.ajax({
                        url: 'start_session.php',
                        method: 'POST',
                        data: {
                            id: studentId
                        },
                        success: function(response) {
                            console.log("Session started successfully");

                            window.open("edit_form.php", '_blank');

                        },
                        error: function(xhr, status, error) {
                            console.error("Error starting session:", error);
                        }
                    });

                } else {
                    console.error("No data found for the row. (export)");
                }
            });
        });
    </script>

    <?php include('../includes/footer.php'); ?>