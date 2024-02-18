<?php
//User auth here / Only user doing the test should be able to access the page.
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test <!-- ID or name of test here? --> </title>
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
        <div class="navbar navbar-dark fixed-bottom bg-dark">
            <div class="navbar-text">
                <!-- Subject | Test name //Could do a colour change between the subject text and the test name //Use vector graphics for a diagonal line?-->
            </div>
            <div class="navbar-text">
                <!-- Current of total eg Question 1 of 5, 2 of 5 -->
            </div>     
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>