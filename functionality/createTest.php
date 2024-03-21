<?php
//User auth here //If practice is set will make a practice test and immediately assign it to the student.
session_start();

if (!isset($_POST['tSubjectSelect']) ||
    !isset($_POST['tName']) ||
    !isset($_POST['tAmount']) ||
    !isset($_POST['tSchedule'])
) {
    die("Please fill out all fields");
}


require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['tSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['tName']);
$amount = $db_connect->real_escape_string($_POST['tAmount']);
$schedule = $db_connect->real_escape_string($_POST['tSchedule']);
$userID = $_SESSION['userID'];

//Prepare SQL query
if ($_POST['practice']) {
    $query = "CALL createPracticeTest(?, ?, ?, ?)";

    if ($db_connect->execute_query($query, [$subject, $name, $amount, $userID]))
        echo "Test created succesfully";
    else
        echo "Error: " . $db_connect->error();
} else {
    $query = "CALL createTest(?, ?, ?, ?)";

    if ($db_connect->execute_query($query, [$subject, $name, $amount, $schedule]))
        echo "Test created succesfully";
    else
        echo "Error: " . $db_connect->error();
}


?>
