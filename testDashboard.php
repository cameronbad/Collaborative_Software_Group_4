<?php
//User auth here
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="container mt-5">
            <div class="card mb-4"> <!-- Topbar -->
                <div class="col-2 card-body stats-left"> <!-- Replace with appropriate icons later -->
                    <h2><span class="badge">Points</span></h2>
                    <h2><span class="badge">Avg</span></h2>
                </div>
                <div class="col"> <!-- Graph -->

                </div>
            </div>
            <!-- Tests -->
            <div class="row">
                <?php 
                include_once("includes/_connect.php");

                $query = "SELECT `result`.*, `test`.*, `subject`.`subjectName` FROM `result` LEFT JOIN `test` ON `result`.`testID` = `test`.`testID` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `result`.`userID` = " . $_SESSION["userID"];

                $run = mysqli_query($db_connect, $query);
                while ($result = mysqli_fetch_assoc($run)) { //Needs = Number of Questions / Percentage of Correct Questions / Total Acquired Points from Test
                    echo "<div class='col-3'>";
                    echo "<div class='card mb-4'>";
                    echo "<h5 class='card-title'>" . $result["testName"] . "</h5>";
                    echo "<h6 class='card-subtitle'>" . $result["subjectName"] . "</h6>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>