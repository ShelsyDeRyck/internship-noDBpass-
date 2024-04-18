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
    <title>Skills</title>
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../styles/skills.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Skills</h2>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#add-skill-modal"><i class="bi bi-plus-square m-2"></i>Skill Toevoegen</button>
        <!-- Button to activate skills -->
        <button type="button" class="btn btn-success mb-3 ml-2" id="activate-skills-btn">Skills Activeren</button>
        <table id="skillsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>Naam</th>
                    <th>Type</th>
                    <th>Beschrijving</th>
                    <th>Status</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically through JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- Bootstrap Modal for Add Skill -->
    <div id="add-skill-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nieuwe Skill Toevoegen</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-skill-form">
                        <div class="form-group">
                            <label for="add-name">Naam:</label>
                            <input type="text" class="form-control" id="add-name">
                        </div>
                        <div class="form-group">
                            <label for="add-type">Type:</label>
                            <select class="form-control" id="add-type">
                                <option value="soft">Soft Skill</option>
                                <option value="hard">Hard Skill</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add-description">Beschrijving:</label>
                            <textarea class="form-control" id="add-description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-skill-btn">Toevoegen</button>
                    <!-- Button to reactivate inactive skills -->
                    <button type="button" class="btn btn-success" id="reactivate-skills-btn">Reactiveren Inactieve Skills</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal for Edit Skill -->
    <div id="edit-skill-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Skill Bewerken</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-skill-form">
                        <input type="hidden" id="edit-skill-id">
                        <div class="form-group">
                            <label for="edit-name">Naam:</label>
                            <input type="text" class="form-control" id="edit-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-type">Type:</label>
                            <select class="form-select" id="edit-type">
                                <option value="soft">Soft Skill</option>
                                <option value="hard">Hard Skill</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Beschrijving:</label>
                            <textarea class="form-control" id="edit-description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="update-skill-btn">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal for Reactivate Skills -->
    <div id="reactivate-skills-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reactiveren Skills</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reactivate-skills-form">
                        <?php
                        // Fetch skills from the database and populate checkboxes
                        foreach ($inactiveSkills as $skill) {
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" id="skill-' . $skill['id'] . '" value="' . $skill['id'] . '">';
                            echo '<label class="form-check-label" for="skill-' . $skill['id'] . '">' . $skill['name'] . '</label>';
                            echo '</div>';
                        }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="reactivate-selected-btn">Reactiveren</button>
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
                columns: [{
                        data: "id",
                        visible: false
                    }, // Hide ID column
                    {
                        data: "name"
                    },
                    {
                        data: "type"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "status",
                        visible: false
                    }, // Hide Status column
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm edit-btn "><i class="bi bi-pencil-square"></i></button>' +
                                '<button class="btn btn-danger btn-sm delete-btn m-1" data-id="' + row.id + '"> <i class="bi bi-trash3"></i></button>';
                        }
                    }
                ]
            });

            // Handle edit button click
            $('#skillsTable tbody').on('click', '.edit-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-skill-id').val(rowData.id);
                    $('#edit-name').val(rowData.name);
                    $('#edit-type').val(rowData.type);
                    $('#edit-description').val(rowData.description);
                    $('#edit-skill-modal').modal('show');
                } else {
                    console.error("No data found for the row.");
                }
            });

            // Handle delete button click
            $('#skillsTable tbody').on('click', '.delete-btn', function() {
                var skillId = $(this).data('id');
                if (skillId) {
                    $.ajax({
                        url: 'soft_delete_skill.php',
                        method: 'POST',
                        data: {
                            id: skillId
                        },
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
                var name = $('#add-name').val();
                var type = $('#add-type').val();
                var description = $('#add-description').val();
                var status = $('#add-status').val();

                $.ajax({
                    url: 'add_skill.php',
                    method: 'POST',
                    data: {
                        name: name,
                        type: type,
                        description: description,
                        status: status
                    },
                    success: function(response) {
                        $('#add-skill-modal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding skill:", error);
                    }
                });
            });

            // Event listener for activating skills button click
            $('#activate-skills-btn').on('click', function() {
                // Fetch inactive skills from the server
                $.ajax({
                    url: 'get_inactive_skills.php',
                    method: 'GET',
                    dataType: 'json', // Specify JSON as the expected data type
                    success: function(response) {
                        // Clear previous content of the modal
                        $('#reactivate-skills-form').empty();

                        // Populate the modal with the list of inactive skills
                        $.each(response, function(index, skill) {
                            $('#reactivate-skills-form').append('<div class="form-check">' +
                                '<input class="form-check-input" type="checkbox" id="skill-' + skill.id + '" value="' + skill.id + '">' +
                                '<label class="form-check-label" for="skill-' + skill.id + '">' + skill.name + '</label>' +
                                '</div>');
                        });

                        // Show the reactivate skills modal
                        $('#reactivate-skills-modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching inactive skills:', error);
                    }
                });
            });

            // Event listener for "Select All" checkbox in the reactivation modal
            $('#check-all').on('change', function() {
                $('.form-check-input').prop('checked', $(this).prop('checked'));
            });

            $('#reactivate-selected-btn').on('click', function() {
                // Get the IDs of selected skills
                var selectedSkills = [];
                $('.form-check-input:checked').each(function() {
                    selectedSkills.push($(this).val());
                });

                if (selectedSkills.length === 0) {
                    console.log('No skills selected for reactivation.');
                    return; // No skills selected, so we don't need to proceed further
                }

                // Send AJAX request to reactivate selected skills
                $.ajax({
                    url: 'reactivate_skills.php',
                    method: 'POST',
                    data: {
                        skills: selectedSkills
                    },
                    success: function(response) {
                        // Handle successful reactivation
                        console.log('Skills reactivated successfully.');
                        // Reload the DataTable
                        table.ajax.reload();
                        // Hide the modal
                        $('#reactivate-skills-modal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error reactivating skills:', error);
                    }
                });
            });

        });
    </script>


    <?php include('../includes/footer.php'); ?>