<?php
//Require php includes
require_once("../includes/_connect.php");

//Check fields have been entered
if (!isset($_POST['tSubjectSelect']) ||
    !isset($_POST['tName']) ||
    !isset($_POST['tAmount'])
) {
    error_log("Some fields needed for this page were not posted!");
    die("Please fill out all fields");
}

@session_start(); 

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['tSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['tName']);
$amount = $db_connect->real_escape_string($_POST['tAmount']);
$userID = $_SESSION['userID'];

//Prepare SQL query
if ($_POST['practice'] == true && $_SESSION['accessLevel'] == 1) {
    $query = "CALL createPracticeTest(?, ?, ?, ?)";

    if ($db_connect->execute_query($query, [$subject, $name, $amount, $userID]))
        echo "Test created succesfully";
    else
        echo "Error: " . $db_connect->error();
} else if ($_POST['practice'] == false && ($_SESSION['accessLevel'] == 2 || $_SESSION['accessLevel'] == 3)) {
    $query = "CALL createTest(?, ?, ?, ?)";

    if (!isset($_POST['tSchedule'])) {
        error_log("Some fields needed for this page were not posted!");
        die("Please fill out all fields");
    }

    $schedule = $db_connect->real_escape_string($_POST['tSchedule']);

    if ($db_connect->execute_query($query, [$subject, $name, $amount, $schedule]))
        echo "Test created succesfully";
    else
        echo "Error: " . $db_connect->error();
} else {
    error_log('Invalid attempt to create test, test type and access level do not match!');
}
?>
