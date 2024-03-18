<?php
//User auth here

if (!isset($_POST['classSelect']) ||
    !isset($_POST['aTestID'])
) {
    die("Please fill out all fields.");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$class = $db_connect->real_escape_string($_POST['classSelect']);
$test = $db_connect->real_escape_string($_POST['aTestID']);

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
while ($user = $users->fetch_assoc()) { //Trimming doesn't work correctly and can cause duplicate entries in some cases, please fix
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