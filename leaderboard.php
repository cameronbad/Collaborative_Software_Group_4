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
                    <option selected>Courses</option>
                    <?php
                        require_once ('includes/_connect.php');

                        $SQL = "CALL allCourseNames()";// Calls the procedure

                        $result = mysqli_query($db_connect, $SQL);

                        $preValue = '0';

                        while(mysqli_next_result($db_connect)){;} //Fixes Unsynch Error

                        while($row = mysqli_fetch_assoc($result)){ //Loops through results and matches the subjects with the courses
                            if($preValue == 0) {
                                echo "<optgroup label=" . $row["courseName"] . ">";
                                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
                                $preValue = $row["courseID"];
                            } else if ($preValue != $row["courseID"]) {
                                echo "</optgroup>";
                                echo "<optgroup label=" . $row["courseName"] . ">";
                                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
                                $preValue = $row["courseID"];
                            } else {
                                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-info"  id="filterbtn">Filter</button>
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
                <?php

require_once ("includes/_connect.php");

$SQL = "CALL topScoringStudents(1)"; //Calls the procedure

$result = mysqli_query($db_connect, $SQL);

while(mysqli_next_result($db_connect)){;} //Fixes Unsynch Error

$Place = 0; //Stores the placement number

$BarNum = 100; //Used to calcualte the progress bar width
$BarNumDiff = 0;

while($row = mysqli_fetch_assoc($result)){ //Loops through the query result

    if($Place > 0){ //Calculates BarNum and doesnt run on the first loop
    $BarNum = $BarNum - ($BarNumDiff - $row['resultTotal']);
    }

    $Place++;

    echo "<tr>";
    echo "<td>" . $Place . "</td>";
    echo "<td>" . $row['username'] . "</td>";?> 

    <td> 
        <div class="progress"><!-- Animated progress bar displaying student's score -->
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $BarNum ?>%"><?php echo $row['resultTotal'] ?></div>
        </div>
    </td><?php

    echo "</tr>";

    $BarNumDiff =  $row['resultTotal']; //Stores previouse score
}
?>
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
