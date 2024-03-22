<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['eSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['eName']);
$amount = $db_connect->real_escape_string($_POST['eAmount']);
$schedule = $db_connect->real_escape_string($_POST['eSchedule']);
$id = $db_connect->real_escape_string($_POST['eTestID']);

//Check authentication
@session_start(); 
testCheck($id, $_SESSION['courseID'], 'Test');
subjectCheck($subject, $_SESSION['courseID'], 'Subject');

//Check fields have been entered
if (!isset($_POST['eSubjectSelect']) ||
    !isset($_POST['eName']) ||
    !isset($_POST['eAmount']) ||
    !isset($_POST['eSchedule']) ||
    !isset($_POST['eTestID'])
) {
    die("Please fill out all fields");
}

//Prepare SQL query
$query = "CALL editTest(?, ?, ?, ?, ?)";

if ($db_connect->execute_query($query, [$subject, $name, $amount, $schedule, $id]))
    echo "Test updated succesfully";
else
    echo "Error: " . $db_connect->error();
?>
