<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Cursussen beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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

                $.ajax({
                    url: 'add_course.php',
                    method: 'POST',
                    data: { name: name, description: description, duration: duration, location: location },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-course-modal').hide();
                    }
                });
            });

            $('#courses-table tbody').on('click', '.edit-course-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.course_id) {
                    $('#edit-course-id').val(rowData.course_id);
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
                if (rowData && rowData.course_id) {
                    var courseId = rowData.course_id;
                    console.log("Course ID:", courseId);
                    $.ajax({
                        url: 'delete_course.php',
                        method: 'POST',
                        data: { id: courseId },
                        success: function(response) {
                            table.ajax.reload();
                        }
                    });
                } else {
                    console.error("No data found for the row.");
                }
            });
        });
    </script>
</body>
</html>