
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Skills beheren</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <?php include ('../includes/bootstrap.php'); ?>
</head>
<body>
<?php include('../includes/navbar_admin.php'); ?>
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

    <!-- Modaal venster voor skill bewerken -->
    <div id="edit-skill-modal" style="display: none;">
        <input type="hidden" id="edit-skill-id">
        <input type="text" id="edit-name" placeholder="Naam"><br>
        <select id="edit-type">
            <option value="Soft">Soft</option>
            <option value="Hard">Hard</option>
        </select><br>
        <input type="text" id="edit-description" placeholder="Beschrijving"><br>
        <button id="update-skill-btn">Bijwerken</button>
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
                    { data: null, defaultContent: "<button class='edit-skill-btn'>Bewerken</button> <button class='delete-skill-btn'>Verwijderen</button>" }
                ]
            });

            $('#add-skill-btn').on('click', function() {
                $('#add-skill-modal').show();
            });

            $('#submit-skill-btn').on('click', function() {
                var name = $('#name').val();
                var type = $('#type').val();
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

            $('#skills-table tbody').on('click', '.edit-skill-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-skill-id').val(rowData.id);
                    $('#edit-name').val(rowData.name);
                    $('#edit-type').val(rowData.type);
                    $('#edit-description').val(rowData.description);
                    $('#edit-skill-modal').show();
                } else {
                    console.error("No data found for the row.");
                }
            });

            $('#update-skill-btn').on('click', function() {
                var id = $('#edit-skill-id').val();
                var name = $('#edit-name').val();
                var type = $('#edit-type').val();
                var description = $('#edit-description').val();

                $.ajax({
                    url: 'update_skill.php',
                    method: 'POST',
                    data: { id: id, name: name, type: type, description: description },
                    success: function(response) {
                        table.ajax.reload();
                        $('#edit-skill-modal').hide();
                    }
                });
            });

            $('#skills-table tbody').on('click', '.delete-skill-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    var Id = rowData.id;
                    console.log("ID:", Id)
                    $.ajax({
                        url: 'delete_skill.php',
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
        });
    </script>
<?php include ('../includes/footer.php') ?>