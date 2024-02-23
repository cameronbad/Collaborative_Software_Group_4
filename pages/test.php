<?php
//User auth here / Only user doing the test should be able to access the page.
@session_start();

//need to $_GET the result ID

require_once("./includes/_connect.php");

$query = "SELECT `test`.`testName`, `subject`.`subjectName`, `result`.`questionTotal`, `result`.`questionCurrent` FROM `result` LEFT JOIN `test` ON `result`.`testID` = `test`.`testID` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `result`.`resultID` = '13'"; //Replace 13 with a GET['resultID'] 
$test = mysqli_fetch_assoc(mysqli_execute_query($db_connect, $query));
$current = $test['questionCurrent'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test | <?= $test['testName'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body class="d-flex flex-column h-100 test-body">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="test-container"> <!-- Question content / fullpage scrolling -->
            <!-- Question / Answers / Submit || Add each question to this container / Existing answers get added on load (initial one created  on first load?)
            Later answers get added by ajax query using page template? -->
        </div>  
        <div class="navbar fixed-bottom test-bottom">
            <div class="navbar-nav flex-row">
                <div class="navbar-text p-3"><?= $test['subjectName'] ?></div>
                <svg class="test-bottom-svg d-inline-block align-text-top">
                    <polygon points='0,0 0,56 30,0'>
                </svg>  
                <div class="navbar-text p-3"><?= $test['testName'] ?></div>
            </div>
            <div class="navbar-nav flex-row">
                <svg class="test-bottom-svg d-inline-block align-text-top">
                    <polygon points='30,56 0,56 30,0'>
                </svg>  
                <div class="navbar-text p-3"><?= $current ?> of <?= $test['questionTotal'] ?></div>
            </div>    
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>