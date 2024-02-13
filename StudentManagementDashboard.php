<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
    <link href="style.css" rel="stylesheet">
</head>
<body id="studentBody" class="m-0 p-0">

<?php include('includes/navbar.php');?> <!-- Grabs the navbar code and displays it on the student management page -->

<div class="container">
    <div class="containter">
        <form class="row" method="POST" id="studentFilterBox">
            <div class="col-10">
                <select class="form-select col" id="classFilters" name="classFilters">
                    <?php include_once("includes/filtersDisplay.php") ?> <!-- Displays subjects for filters -->
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn"  id="filterbtn">Filter</button>
            </div>
        </form>
    </div>

    <div class="container-fluid mt-5">
        <table class="table table-hover table-bordered" id="studentTableMain">
            <thead>
                <tr>
                    <th class="col-1" scope="col">Number</th>
                    <th class="col-2" scope="col">Name</th>
                    <th class="col-2" scope="col">Surname</th>
                    <th class="col-2" scope="col">Username</th>
                    <th class="col-3" scope="col">Email</th>
                    <th class="col-3" scope="col">Last Login</th>
               </tr>
            </thead>
            <tbody>
                <?php include_once("includes/studentManageOutput.php") ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>