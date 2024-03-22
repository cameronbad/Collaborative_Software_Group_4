<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$id = $db_connect->real_escape_string($_POST['dTestID']);

//Check authentication
@session_start(); 
testCheck($id, $_SESSION['courseID'], 'Test');

//Check fields have been entered
if (!isset($_POST['dTestID'])) {
    die("Please fill out all fields");
}

//Prepare SQL Query
$query = "CALL deleteTest(?)";

if ($db_connect->execute_query($query, [$id]))
    echo "Delete succesful";
else
    echo "Error: " . $db_connect->error();
?>