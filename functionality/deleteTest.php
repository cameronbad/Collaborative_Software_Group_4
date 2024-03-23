<?php
//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");

//Check fields have been entered
if (!isset($_POST['dTestID'])) {
    error_log("Some fields needed for this page were not posted!");
    die("Please fill out all fields");
}

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$id = $db_connect->real_escape_string($_POST['dTestID']);

//Check authentication
@session_start(); 
testCheck($db_connect, $id, $_SESSION['courseID'], 'Test');

//Prepare SQL Query
$query = "CALL deleteTest(?)";

if ($db_connect->execute_query($query, [$id]))
    echo "Delete succesful";
else
    echo "Error: " . $db_connect->error();
?>