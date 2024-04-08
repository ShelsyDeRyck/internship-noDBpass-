<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Cursussen</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Cursussen</h1>

    <button id="add-course-btn">Cursus Toevoegen</button>

    <table id="courses-table" class="display">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Duur (uur)</th>
                <th>Locatie</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modaal venster voor cursus toevoegen -->
    <div id="add-course-modal" style="display: none;">
        <input type="text" id="name" placeholder="Naam"><br>
        <input type="text" id="description" placeholder="Omschrijving"><br>
        <input type="text" id="duration" placeholder="Duur (uur)"><br>
        <input type="text" id="location" placeholder="Locatie"><br>
        <button id="submit-course-btn">Toevoegen</button>
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
            { data: null, defaultContent: "<button class='delete-course-btn'>Verwijderen</button>" }
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

    $('#courses-table tbody').on('click', '.delete-course-btn', function() {
        var rowData = table.row($(this).closest('tr')).data();
        if (rowData && rowData.course_id) { // Adjusted to use "course_id" instead of "id"
            var courseId = rowData.course_id; // Adjusted variable name to match
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
