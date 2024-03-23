<?php
//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");

//Check fields have been entered
if (!isset($_POST['eSubjectSelect']) ||
    !isset($_POST['eName']) ||
    !isset($_POST['eAmount']) ||
    !isset($_POST['eSchedule']) ||
    !isset($_POST['eTestID'])
) {
    error_log("Some fields needed for this page were not posted!");
    die("Please fill out all fields");
}

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['eSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['eName']);
$amount = $db_connect->real_escape_string($_POST['eAmount']);
$schedule = $db_connect->real_escape_string($_POST['eSchedule']);
$id = $db_connect->real_escape_string($_POST['eTestID']);

//Check authentication
@session_start(); 
testCheck($db_connect, $id, $_SESSION['courseID'], 'Test');
testCheck($db_connect, $subject, $_SESSION['courseID'], 'Subject');

//Prepare SQL query
$query = "CALL editTest(?, ?, ?, ?, ?)";

if ($db_connect->execute_query($query, [$subject, $name, $amount, $schedule, $id]))
    echo "Test updated succesfully";
else
    echo "Error: " . $db_connect->error();
?>
