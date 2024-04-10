<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Skills</title>
<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>
<body>
<?php include('../includes/navbar_admin.php'); ?>
<div class="container mt-5">
    <h2>Skills</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add-skill-modal">Add Skill</button>
    <table id="skillsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated dynamically through JavaScript -->
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal for Edit Skill -->
<div id="edit-skill-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Skill</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-skill-form">
                    <input type="hidden" id="edit-skill-id">
                    <div class="form-group">
                        <label for="edit-skill-name">Name:</label>
                        <input type="text" class="form-control" id="edit-skill-name">
                    </div>
                    <div class="form-group">
                        <label for="edit-skill-description">Description:</label>
                        <textarea class="form-control" id="edit-skill-description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-skill-type">Type:</label>
                        <select class="form-select" id="edit-skill-type">
                            <option value="soft">Soft Skill</option>
                            <option value="hard">Hard Skill</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-skill-btn">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal for Add Skill -->
<div id="add-skill-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Skill</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-skill-form">
                    <div class="form-group">
                        <label for="add-skill-name">Name:</label>
                        <input type="text" class="form-control" id="add-skill-name">
                    </div>
                    <div class="form-group">
                        <label for="add-skill-description">Description:</label>
                        <textarea class="form-control" id="add-skill-description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="add-skill-type">Type:</label>
                        <select class="form-select" id="add-skill-type">
                            <option value="soft">Soft Skill</option>
                            <option value="hard">Hard Skill</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-skill-btn">Add</button>
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
    var table = $('#skillsTable').DataTable({
        ajax: {
            url: "get_skills.php", // Endpoint to fetch skills data
            dataSrc: ""
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "description" },
            { data: "type" },
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
    $('#skillsTable tbody').on('click', '.edit-btn', function() {
        var rowData = table.row($(this).closest('tr')).data();
        if (rowData && rowData.id) {
            $('#edit-skill-id').val(rowData.id);
            $('#edit-skill-name').val(rowData.name);
            $('#edit-skill-description').val(rowData.description);
            $('#edit-skill-type').val(rowData.type);
            $('#edit-skill-modal').modal('show');
        } else {
            console.error("No data found for the row.");
        }
    });

    // Handle update skill button click
    $('#update-skill-btn').on('click', function() {
        var id = $('#edit-skill-id').val();
        var name = $('#edit-skill-name').val();
        var description = $('#edit-skill-description').val();
        var type = $('#edit-skill-type').val();

        $.ajax({
            url: 'update_skill.php',
            method: 'POST',
            data: { id: id, name: name, description: description, type: type },
            success: function(response) {
                $('#edit-skill-modal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error updating skill:", error);
            }
        });
    });

    // Handle delete button click
    $('#skillsTable tbody').on('click', '.delete-btn', function() {
        var skillId = $(this).data('id');
        if (skillId) {
            $.ajax({
                url: 'delete_skill.php',
                method: 'POST',
                data: { id: skillId },
                success: function(response) {
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting skill:", error);
                }
            });
        } else {
            console.error("No data found for the row.");
        }
    });

    // Handle add skill button click
    $('#add-skill-btn').on('click', function() {
        var name = $('#add-skill-name').val();
        var description = $('#add-skill-description').val();
        var type = $('#add-skill-type').val();

        $.ajax({
            url: 'add_skill.php',
            method: 'POST',
            data: { name: name, description: description, type: type },
            success: function(response) {
                $('#add-skill-modal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error adding skill:", error);
            }
        });
    });
});
</script>

<?php include('../includes/footer.php'); ?>
</body>
</html>
