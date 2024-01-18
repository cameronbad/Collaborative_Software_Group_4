<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sb-1.6.0/sp-2.2.0/datatables.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="#" type="image/x-icon">
</head>
<body class="m-0 p-0">
    
    <?php include 'includes/navbar.php';?> <!-- Grabs the navbar code and displays it on the leaderboard page -->

    <section class="leaderboardMain">
        <table id="leaderboard" class="leaderboard" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Luke</td>
                    <td>2b</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td scope="row">Luke</td>
                    <td>2b</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td scope="row">Luke</td>
                    <td>2b</td>
                    <td>50</td>
                </tr>
            </tbody>
        </table>
    </section>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sb-1.6.0/sp-2.2.0/datatables.min.js"></script>
<script> new DataTable('#leaderboard'); </script>