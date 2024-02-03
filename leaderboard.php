<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body id="leaderboardBody" class="m-0 p-0">
<?php include('includes/navbar.php');?> <!-- Grabs the navbar code and displays it on the leaderboard page -->
<div class="container">
    <div class="lBoardBanner">
        <h1> Lets look at our top scorers! </h1>
    </div>

    <div class="containter">
        <form class="filters row">
            <div class="col-5">
                <select class="form-select" id="subjectFilter" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-5">
                <select class="form-select col" id="classFilters" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-info" id="filterbtn">Info</button>
            </div>
        </form>
    </div>

    <div class="container-fluid"><!-- Leaderboard container -->
        <table id="leaderboard" class="table table-primary table-hover">
            <thead><!-- Table headers -->
                <tr>
                    <th class="col-3" id="placementCol" scope="col">Placement</th>
                    <th class="col-3" id="nameCol" scope="col">Name</th>
                    <th class="col-3" id="scoreCol" scope="col">Score</th>
                </tr>
            </thead>
            <tbody><!-- Table Contents -->
                <?php include('includes/topScorers.php') ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.js"></script>
<script> new DataTable('#leaderboard',{ //Datatable styling
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    stateSave: true,
}); </script>
