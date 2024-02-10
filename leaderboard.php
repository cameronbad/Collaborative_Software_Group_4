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
        <form class="row" method="POST" id="filterBox">
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

    <div class="container-fluid"><!-- Leaderboard container -->
        <table id="leaderboard" class="table table-primary table-hover">
            <thead><!-- Table headers -->
                <tr>
                    <th class="col-1" scope="col">Placement</th>
                    <th class="col-3" scope="col">Name</th>
                    <th class="col-12" scope="col">Score</th>
                </tr>
            </thead>
            <tbody id="leaderboardDisplay"><!-- Table Contents -->
                        <?php  include_once("includes/defaultScorers.php"); ?> <!-- Grabs a default table based on the users course -->
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
}); 
</script>
<script>
     $('#filterBox').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "includes/topScorers.php",
                method: "POST",
                data: $('#filterBox').serialize(),
                success: function(data) {
                    $('#leaderboardDisplay').html(data);
                }
            })
        });
</script>
