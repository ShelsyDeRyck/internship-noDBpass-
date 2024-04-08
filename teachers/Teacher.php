<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Teachers beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Teachers beheren</h1>

    <button id="add-teacher-btn">Teacher Toevoegen</button>

    <table id="teachers-table" class="display">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modal window for adding a teacher -->
    <div id="add-teacher-modal" style="display: none;">
        <input type="text" id="first_name" placeholder="First Name"><br>
        <input type="text" id="last_name" placeholder="Last Name"><br>
        <input type="text" id="email" placeholder="Email"><br>
        <input type="password" id="password" placeholder="Password"><br> <!-- Add password field -->
        <button id="submit-teacher-btn">Add Teacher</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
                    { data: "password" }, // Add password column
                    { data: null, defaultContent: "<button class='delete-teacher-btn'>Delete</button>" }
                ]
            });

            $('#add-teacher-btn').on('click', function() {
                $('#add-teacher-modal').show();
            });

            $('#submit-teacher-btn').on('click', function() {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    url: 'add_teacher.php',
                    method: 'POST',
                    data: { first_name: first_name, last_name: last_name, email: email, password: password }, // Include password in data
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-teacher-modal').hide();
                    }
                });
            });

            $('#teachers-table tbody').on('click', '.delete-teacher-btn', function() {
    var rowData = table.row($(this).closest('tr')).data();
    console.log(rowData); // Log rowData to see its content
    if (rowData && rowData.docent_id) { // Use docent_id instead of teacher_id
        var teacherId = rowData.docent_id; // Use docent_id instead of teacher_id
        console.log("Teacher ID:", teacherId);
        $.ajax({
            url: 'delete_teacher.php',
            method: 'POST',
            data: { id: teacherId },
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