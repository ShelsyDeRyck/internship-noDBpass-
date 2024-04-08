<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Skills beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Skills beheren</h1>

    <button id="add-skill-btn">Skill Toevoegen</button>

    <table id="skills-table" class="display">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Type</th>
                <th>Beschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modaal venster voor skill toevoegen -->
    <div id="add-skill-modal" style="display: none;">
        <input type="text" id="name" placeholder="Naam"><br>
        <select id="type">
            <option value="Soft">Soft</option>
            <option value="Hard">Hard</option>
        </select><br>
        <input type="text" id="description" placeholder="Beschrijving"><br>
        <button id="submit-skill-btn">Toevoegen</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#skills-table').DataTable({
                ajax: {
                    url: "get_skills.php",
                    dataSrc: ""
                },
                columns: [
                    { data: "name" },
                    { data: "type" },
                    { data: "description" },
                    { data: null, defaultContent: "<button class='delete-skill-btn'>Verwijderen</button>" }
                ]
            });

            $('#add-skill-btn').on('click', function() {
                $('#add-skill-modal').show();
            });

            $('#submit-skill-btn').on('click', function() {
                var name = $('#name').val();
                var type = $('#type').val(); // Get the selected type from the dropdown
                var description = $('#description').val();

                $.ajax({
                    url: 'add_skill.php',
                    method: 'POST',
                    data: { name: name, type: type, description: description },
                    success: function(response) {
                        table.ajax.reload();
                        $('#add-skill-modal').hide();
                    }
                });
            });

            $('#skills-table tbody').on('click', '.delete-skill-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.skill_id) {
                    var skillId = rowData.skill_id;
                    console.log("Skill ID:", skillId);
                    $.ajax({
                        url: 'delete_skill.php',
                        method: 'POST',
                        data: { id: skillId },
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