
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Studenten beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Studenten beheren</h1>

    <button id="add-student-btn">Student Toevoegen</button>

    <table id="students-table" class="display">
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Geboortedatum</th>
                <th>Studiejaar</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modaal venster voor student toevoegen -->
    <div id="add-student-modal" style="display: none;">
        <input type="text" id="first_name" placeholder="Voornaam"><br>
        <input type="text" id="last_name" placeholder="Achternaam"><br>
        <input type="email" id="email" placeholder="Email"><br>
        <input type="date" id="date_of_birth" placeholder="Geboortedatum"><br>
        <input type="number" id="study_year" placeholder="Studiejaar"><br>
        <button id="submit-student-btn">Toevoegen</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#students-table').DataTable({
                ajax: {
                    url: "get_students.php",
                    dataSrc: ""
                },
                columns: [
                    { data: "first_name" },
                    { data: "last_name" },
                    { data: "email" },
                    { data: "date_of_birth" },
                    { data: "study_year" },
                    { data: null, defaultContent: "<button class='delete-student-btn'>Verwijderen</button>" }
                ]
            });

            $('#add-student-btn').on('click', function() {
                $('#add-student-modal').show();
            });

            $('#submit-student-btn').on('click', function() {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var date_of_birth = $('#date_of_birth').val();
                var study_year = $('#study_year').val();

                $.ajax({
                    url: 'add_student.php',
                    method: 'POST',
                    data: { first_name: first_name, last_name: last_name, email: email, date_of_birth: date_of_birth, study_year: study_year },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-student-modal').hide();
                    }
                });
            });

            $('#students-table tbody').on('click', '.delete-student-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.student_id) {
                    var studentId = rowData.student_id;
                    console.log("Student ID:", studentId);
                    $.ajax({
                        url: 'delete_student.php',
                        method: 'POST',
                        data: { id: studentId },
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