<?php
//User auth here
@session_start();

require_once("./includes/_connect.php");

$query = "SELECT SUM(`questionTotal`) AS totalQuestions, SUM(`questionCorrect`) AS totalCorrect, SUM(`points`) AS totalPoints FROM `result` WHERE `completionDate` IS NOT NULL AND `result`.`userID` = " . $_SESSION["userID"];

$userResult = mysqli_fetch_assoc(mysqli_execute_query($db_connect, $query));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="parallax py-5">
            <div class="container">
                <div class="card"> <!-- Topbar -->
                    <div class="row">
                        <div class="col-2 card-body stats-left"> <!-- Replace with appropriate icons later -->
                            <h2><span class="badge">Points: <?= $userResult['totalPoints'] ?> </span></h2>
                            <h2><span class="badge">Avg: <?php if($userResult['totalQuestions'] != 0) {echo $userResult['totalCorrect'] / $userResult['totalQuestions'];}?></span></h2>
                        </div>
                        <div class="col-10"> <!-- Graph -->
                            <canvas id="statChart" style="width:100%; max-height:150px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">

            <!-- Tests -->
            <div class="row">
                <?php 
                include_once("includes/_connect.php");

                $query = "SELECT `result`.*, `test`.*, `subject`.`subjectName` FROM `result` LEFT JOIN `test` ON `result`.`testID` = `test`.`testID` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `result`.`userID` = " . $_SESSION["userID"];

                $run = mysqli_query($db_connect, $query);
                while ($result = mysqli_fetch_assoc($run)) {
                    echo "<div class='col'>";
                    echo "<div class='card test-card'>";
                    echo "<div class='card-header text-center'>" . $result["subjectName"] . "</div>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $result["testName"] . "</h5>";
                    echo "<div class='row text-center'>";
                    echo "<div class='col-4'>Questions: " . $result['questionTotal'] . "</div>"; //Number of question
                    echo "<div class='col-4'>Correct: "; 
                    if (is_null($result['completionDate'])) {echo "N/A";} else {echo $result['questionCorrect'] / $result['questionTotal'] . "%";}
                    echo "</div>"; //Percentage correct
                    echo "<div class='col-4'>Points: ";
                    if (is_null($result['completionDate'])) {echo "N/A";} else {echo $result['points'];}
                    echo "</div>"; //Total points
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='card-footer text-center'>"; //Completion date / Not started / In progress (colour coding?)
                    if (!is_null($result['completionDate'])) {echo $result['completionDate'];} elseif (is_null($result['questionCurrent'])) {echo "Incomplete";} else {echo "In progress";}
                    echo "</div>";
                    echo "<a href='#'></a>"; //Add routing to correct testing page when said page is created.
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script> //User json encoding of php arrays below
        <?php 
        include_once("includes/_connect.php");
        $query = "SELECT `test`.`testName`, `result`.`questionTotal`, `result`.`questionCorrect` FROM `result` LEFT JOIN `test` ON `result`.`testID` = `test`.`testID` WHERE `completionDate` IS NOT NULL AND `result`.`userID` = " . $_SESSION["userID"];
        
        $name = [];
        $avg = [];

        $run = mysqli_query($db_connect, $query);
        while ($result = mysqli_fetch_assoc($run)) {
            $name[] = $result['testName'];
            $avg[] = $result['questionCorrect'] / $result['questionTotal'];
        }
        ?>

        const xValues = <?= json_encode($name); ?>; //Name of test
        const yValues = <?= json_encode($avg); ?>; //Average score

        new Chart("statChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Percentage Mark',
                    data: yValues
                }]
            },
        });
    </script>
</body>
</html>