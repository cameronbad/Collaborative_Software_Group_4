<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
    <link href="style.css" rel="stylesheet">
</head>
<body class="m-0 p-0" id="studentProfileBody">

<?php include('includes/navbar.php');?> <!-- Grabs the navbar code and displays it on the student management page -->

<div class="container p-5">
    <div class="studentProfileBack">
        <button type="submit" class="btn btn-danger">Back</button>
    </div>
    <div class="container" id="studentProfileMain">
        <div class="studentProfileLeft">
            <div>
                <img alt="Profile Picture">
            </div>
            <div>
                <p>stuff</p>
            </div>
        </div>
            <div class="studentProfileRight">

            <?php
                $SQL="CALL studentPRofileUser(1)";
            ?>

            <form>
                <div class="mb-3">
                    <label for="studentProfileID" class="form-label">ID</label>
                    <input type="text" class="form-control" id="studentProfileID">
                </div>
                <div class="mb-3">
                    <label for="studentProfileUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="studentProfileUsername">
                </div>
                <div class="mb-3">
                    <label for="studentProfileName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="studentProfileName">
                </div>
                <div class="mb-3">
                    <label for="studentProfileEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="studentProfileEmail">
                </div>
                <div class="mb-3">
                    <label for="studentProfileNumber" class="form-label">Student Number</label>
                    <input type="text" class="form-control" id="studentProfileNumber">
                </div>
                <div class="mb-3">
                    <label for="studentProfileCourse" class="form-label">Course</label>
                    <input type="text" class="form-control" id="studentProfileCourse">
                </div>
                <div class="mb-3">
                    <label for="studentProfileState" class="form-label">Account State</label>
                    <input type="text" class="form-control" id="studentProfileState">
                </div>
                <div class="mb-3">
                    <label for="studentProfileLogin" class="form-label">Last Login</label>
                    <input type="text" class="form-control" id="studentProfileLogin">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        <div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>