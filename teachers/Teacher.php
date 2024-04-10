<?php include ('../includes/navbar_admin.php') ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Docenten beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <?php include ('../includes/bootstrap.php'); ?>
</head>
<body>
    <h1>Docenten beheren</h1>

    <button id="add-teacher-btn">Docent Toevoegen</button>

    <table id="teachers-table" class="display">
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modaal venster voor docent toevoegen -->
    <div id="add-teacher-modal" style="display: none;">
        <input type="text" id="first_name" placeholder="Voornaam"><br>
        <input type="text" id="last_name" placeholder="Achternaam"><br>
        <input type="email" id="email" placeholder="Email"><br>
        <button id="submit-teacher-btn">Toevoegen</button>
    </div>

    <!-- Modaal venster voor docent bewerken -->
    <div id="edit-teacher-modal" style="display: none;">
        <input type="hidden" id="edit-teacher-id">
        <input type="text" id="edit-first_name" placeholder="Voornaam"><br>
        <input type="text" id="edit-last_name" placeholder="Achternaam"><br>
        <input type="email" id="edit-email" placeholder="Email"><br>
        <button id="update-teacher-btn">Bijwerken</button>
    </div>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
        <div class="toast-header">
            <strong class="mr-auto">Notification</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#teachers-table').DataTable({
                ajax: {
                    url: "get_teachers.php",
                    dataSrc: ""
                },
                columns: [
                    { data: "first_name" },
                    { data: "last_name" },
                    { data: "email" },
                    { data: null, defaultContent: "<button class='edit-teacher-btn'>Bewerken</button> <button class='delete-teacher-btn'>Verwijderen</button>" }
                ]
            });

            $('#add-teacher-btn').on('click', function() {
                $('#add-teacher-modal').show();
            });

            $('#submit-teacher-btn').on('click', function() {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();

                if (first_name.trim() === '' || last_name.trim() === '' || email.trim() === '' || location.trim() === '') {
                    showToast("vull alle velden in");
                    return;
                }

                $.ajax({
                    url: 'add_teacher.php',
                    method: 'POST',
                    data: { first_name: first_name, last_name: last_name, email: email },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-teacher-modal').hide();
                        showToast("teacher succesvol toegevoegd.");

                    }
                });
            });

            $('#teachers-table tbody').on('click', '.edit-teacher-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-teacher-id').val(rowData.id);
                    $('#edit-first_name').val(rowData.first_name);
                    $('#edit-last_name').val(rowData.last_name);
                    $('#edit-email').val(rowData.email);
                    $('#edit-teacher-modal').show();
                } else {
                    console.error("No data found for the row.");
                }
            });

            $('#update-teacher-btn').on('click', function() {
                var id = $('#edit-teacher-id').val();
                var first_name = $('#edit-first_name').val();
                var last_name = $('#edit-last_name').val();
                var email = $('#edit-email').val();

                $.ajax({
                    url: 'update_teacher.php',
                    method: 'POST',
                    data: { id: id, first_name: first_name, last_name: last_name, email: email },
                    success: function(response) {
                        table.ajax.reload();
                        $('#edit-teacher-modal').hide();
                    }
                });
            });

            $('#teachers-table tbody').on('click', '.delete-teacher-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    var Id = rowData.id;
                    console.log("Teacher ID:", Id);
                    $.ajax({
                        url: 'delete_teacher.php',
                        method: 'POST',
                        data: { id: Id },
                        success: function(response) {
                            table.ajax.reload();
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
        });
    </script>
<?php include('../includes/footer.php'); ?>