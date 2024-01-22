<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="#" type="image/x-icon">
</head>
<body class="m-0 p-0" style="width:100%; height:100vh; background-color: ##d8dede;">
    
    <?php include 'includes/navbar.php';?> <!-- Grabs the navbar code and displays it on the leaderboard page -->

    <div class="container-fluid">
        <table id="leaderboard" class="table table-primary table-hover" style="width: 80%; margin: auto; padding-top:5%; border-collapse: seperate; border-spacing:0 20px;"><!-- Table styling will be moved after merger to the sylesheet-->
            <thead>
                <tr><!-- Table headers -->
                    <th scope="col">Placement</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody><!-- Table Contents -->
                <tr>
                    <th scope="row">1</th>
                    <td>Luke</td>
                    <td>2b</td>
                    <td>
                        <div class="progress"><!-- Animated progress bar displaying student's score -->
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Luke</td>
                    <td>2b</td>
                    <td>
                        <div class="progress"><!-- Animated progress bar displaying student's score -->
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Luke</td>
                    <td>2b</td>
                    <td>
                        <div class="progress"><!-- Animated progress bar displaying student's score -->
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Luke</td>
                    <td>2b</td>
                    <td>
                        <div class="progress"><!-- Animated progress bar displaying student's score -->
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Luke</td>
                    <td>2b</td>
                    <td>
                        <div class="progress"><!-- Animated progress bar displaying student's score -->
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
</div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.js"></script>
<script> new DataTable('#leaderboard',{
    paging: false,
    ordering: false,
    info: false,
    searching: false,
    stateSave: true,
}); </script>