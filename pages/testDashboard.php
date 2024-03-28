<?php
@session_start();
if ($_SESSION['accessLevel'] == 1) {
    //Auth passed
} else if ($_SESSION['accessLevel'] == 2) {
    //Auth failed, teacher
    header("Location: ./studentDisplay");
    die();
} else if ($_SESSION['accessLevel'] == 3) {
    //Auth failed, admin
    header("Location: ./adminDashboard");
    die();
} else {
    //Not logged in
    header("Location: ./");
    die();
}

require_once("./includes/_connect.php");

$query = "CALL calculateUserResult(?)";

$userResult = $db_connect->execute_query($query, [$_SESSION['userID']])->fetch_assoc();
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
                            <h2><span class="badge">Points: <?= $userResult['totalCorrect'] * 30 - (($userResult['totalQuestions'] - $userResult['totalCorrect']) * 10) ?> </span></h2>
                            <h2><span class="badge">Avg: <?php if($userResult['totalQuestions'] != 0) {echo $userResult['totalCorrect'] / $userResult['totalQuestions'] * 100 . "%";}?></span></h2>
                        </div>
                        <div class="col-10"> <!-- Graph -->
                            <canvas id="statChart" style="width:100%; max-height:150px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-success mt-5" data-bs-toggle='modal' data-bs-target='#testModal'>Create a new test</button>
                </div>
            </div>
        </div>
        <div class="container mt-5">

            <!-- Tests -->
            <div class="row">
                <?php 
                include_once("includes/_connect.php");

                $query = "CALL getTestDashboard(?)";

                $run = $db_connect->execute_query($query, [$_SESSION['userID']]);
                while ($result = $run->fetch_assoc()) {
                    echo "<div class='col d-flex justify-content-center mt-3'>";
                    echo "<div class='card test-card'>";
                    echo "<div class='card-header text-center'>" . $result["subjectName"] . "</div>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $result["testName"] . "</h5>";
                    echo "<div class='row text-center'>";
                    echo "<div class='col-4'>Questions " . $result['questionTotal'] . "</div>"; //Number of question
                    echo "<div class='col-4'>Correct "; 
                    if (is_null($result['completionDate'])) {echo "N/A";} else {echo $result['questionCorrect'] / $result['questionTotal'] * 100 . "%";}
                    echo "</div>"; //Percentage correct
                    echo "<div class='col-4'>Points ";
                    if (is_null($result['completionDate'])) {echo "N/A";} else {echo $result['questionCorrect'] * 30 - (($result['questionTotal'] - $result['questionCorrect']) * 10);}
                    echo "</div>"; //Total points
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='card-footer text-center'>"; //Completion date / Not started / In progress (colour coding?)
                    if (!is_null($result['completionDate'])) {echo $result['completionDate'];} elseif ($result['questionCurrent'] == 0) {echo "Incomplete";} else {echo "In progress";}
                    echo "</div>";
                    echo "<a href='test_" . $result['resultID'] . "'></a>"; //Add routing to correct testing page when said page is created.
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            
        </div>
        <?php include_once("includes/testManagementModal.php"); ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="includes/_functions.js"></script>
    <script> //User json encoding of php arrays below
        <?php 
        $db_connect->next_result();
        include_once("./includes/_connect.php");
        $query = "CALL getBarChart(?)";
        
        $name = [];
        $avg = [];

        $run = $db_connect->execute_query($query, [$_SESSION["userID"]]);
        while ($result = $run->fetch_assoc()) {
            if($result['questionCorrect'] != 0) {
                $name[] = $result['testName'];
                $avg[] = $result['questionCorrect'] / $result['questionTotal'] * 100;
            }
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

        //AJAX call to create a test
        ajaxFormSubmit('#testForm', "./functionality/createTest.php", true);
    </script>
</body>
</html>