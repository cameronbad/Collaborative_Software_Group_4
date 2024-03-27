<?php include_once("functionality/loginCheck.php") ?> <!-- Checks if the user has logged in -->
<?php include_once("functionality/authCheck.php") ?> <!-- Checks if the user is of the correct access level -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body>
    <div class="classBack">
        <?php include_once("includes/navbar.php"); ?>
        <div class="container">
            <div class="classMain">
                <div class="newClassContainer">
                    <button type='button' class='btn btn-primary newClassBtn' data-bs-toggle="modal" data-bs-target="#newClassModal">Create New</button> <!-- Opens the class creation modal -->
                </div>
                <div class="container">
                    <table class="table" id="classTable" name="classTable"> <!-- Table for class data -->
                        <thead>
                            <tr>
                                <th scope="col">Class ID</th>
                                <th scope="col">Class Name</th>
                                <th scope="col">Course</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include_once("includes/classesTable.php"); ?> <!-- Table data is generated using SQL -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once("includes/newClassModal.php") ?> <!-- Modal for creating new classes -->
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$('#newClassForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "functionality/createNewClass.php",
                method: "POST",
                data: $('#newClassForm').serialize(),
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            })
        });

$('.deleteClassBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "functionality/deleteClass.php",
                method: "POST",
                data: {classID: $(this).val()},
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            })
        });
</script>