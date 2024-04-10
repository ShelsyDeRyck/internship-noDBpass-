<?php include('../includes/navbar_admin.php'); ?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <title>Cursussen beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <?php include ('../includes/bootstrap.php'); ?>
</head>
<body>
    <h1>Cursussen beheren</h1>

    <button id="add-course-btn">Cursus Toevoegen</button>

    <table id="courses-table" class="display">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Duur</th>
                <th>Locatie</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


    <!-- Modaal venster voor cursus toevoegen -->
    <div id="add-course-modal" style="display: none;">
        <input type="text" id="name" placeholder="Naam"><br>
        <input type="text" id="description" placeholder="Beschrijving"><br>
        <input type="text" id="duration" placeholder="Duur"><br>
        <input type="text" id="location" placeholder="Locatie"><br>
        <button id="submit-course-btn">Toevoegen</button>
    </div>

    <!-- Modaal venster voor cursus bewerken -->
    <div id="edit-course-modal" style="display: none;">
        <input type="hidden" id="edit-course-id">
        <input type="text" id="edit-name" placeholder="Naam"><br>
        <input type="text" id="edit-description" placeholder="Beschrijving"><br>
        <input type="text" id="edit-duration" placeholder="Duur"><br>
        <input type="text" id="edit-location" placeholder="Locatie"><br>
        <button id="update-course-btn">Bijwerken</button>
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
            var table = $('#courses-table').DataTable({
                ajax: {
                    url: "get_courses.php",
                    dataSrc: ""
                },
                columns: [
                    { data: "name" },
                    { data: "description" },
                    { data: "duration" },
                    { data: "location" },
                    { data: null, defaultContent: "<button class='edit-course-btn'>Bewerken</button> <button class='delete-course-btn'>Verwijderen</button>" }
                ]
            });

            $('#add-course-btn').on('click', function() {
                $('#add-course-modal').show();
            });

            $('#submit-course-btn').on('click', function() {
                var name = $('#name').val();
                var description = $('#description').val();
                var duration = $('#duration').val();
                var location = $('#location').val();

                if (name.trim() === '' || description.trim() === '' || duration.trim() === '' || location.trim() === '') {
                    showToast("vull alle velden in");
                    return;
                }

                $.ajax({
                    url: 'add_course.php',
                    method: 'POST',
                    data: { name: name, description: description, duration: duration, location: location },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-course-modal').hide();
                        showToast("Course is succesvol toegevoegd.");
                    }
                });
            });

            $('#courses-table tbody').on('click', '.edit-course-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-course-id').val(rowData.id);
                    $('#edit-name').val(rowData.name);
                    $('#edit-description').val(rowData.description);
                    $('#edit-duration').val(rowData.duration);
                    $('#edit-location').val(rowData.location);
                    $('#edit-course-modal').show();
                } else {
                    console.error("No data found for the row.");
                }
            });

            $('#update-course-btn').on('click', function() {
                var id = $('#edit-course-id').val();
                var name = $('#edit-name').val();
                var description = $('#edit-description').val();
                var duration = $('#edit-duration').val();
                var location = $('#edit-location').val();

                $.ajax({
                    url: 'update_course.php',
                    method: 'POST',
                    data: { id: id, name: name, description: description, duration: duration, location: location },
                    success: function(response) {
                        table.ajax.reload();
                        $('#edit-course-modal').hide();
                    }
                });
            });

            $('#courses-table tbody').on('click', '.delete-course-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    var Id = rowData.id;
                    console.log("Course ID:", Id);
                    $.ajax({
                        url: 'delete_course.php',
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