<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$class = $db_connect->real_escape_string($_POST['classSelect']);
$test = $db_connect->real_escape_string($_POST['aTestID']);

//Check authentication
@session_start(); 
testCheck($test, $_SESSION['courseID']);
classCheck($class, $_SESSION['courseID']);

//Check fields have been entered
if (!isset($_POST['classSelect']) ||
    !isset($_POST['aTestID'])
) {
    die("Please fill out all fields.");
}



//Get questionTotal
$totalQuery = "CALL getQuestionAmount(?)"; 
$totalArray = $db_connect->execute_query($totalQuery, [$test])->fetch_assoc();
$total = $totalArray['questionAmount'];

//Get userID's of `class`, `member`             //Add error checking for a class with no members!
$getQuery = "CALL getClassMember(?)"; 
$users = $db_connect->execute_query($getQuery, [$class]);


//Trim userID's of results that already exist
$trimQuery = "CALL trimClassMember(?, ?)";

$trim = [];
while ($user = $users->fetch_assoc()) { 
    $trimResult = $db_connect->execute_query($trimQuery, [$test, $user['userID']]);
    if ($trimResult->num_rows === 0) {
        $trim[] = $user['userID'];
    }
}

//Free up unneeded memory
$users->free_result();
$trimResult->free_result();

//Create results from all userID's according to the test
$query = "CALL assignTest(?, ?, ?)";

$count = 0;

foreach ($trim as $member) {
    if ($db_connect->execute_query($query, [$test, $member, $total])) {
        $count = $count + 1;
    }
}

die($count . " students have been assigned to this test succcessfully!")


?>