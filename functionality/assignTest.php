<?php
//User auth here

if (!isset($_POST['classSelect']) ||
    !isset($_POST['aTestID'])
) {
    die("Please fill out all fields");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$class = $db_connect->real_escape_string($_POST['classSelect']);
$test = $db_connect->real_escape_string($_POST['aTestID']);

//Get questionTotal
$totalQuery = "SELECT `test`.`questionAmount` FROM `test` WHERE `test`.`testID` = ?"; 
$totalStmt = $db_connect->prepare($totalQuery);
$totalStmt->bind_param("i", $test);
$totalStmt->execute();
$totalArray = $totalStmt->get_result()->fetch_assoc();
$total = $totalArray['questionAmount'];

//Get userID's of `class`, `member`             //Add error checking for a class with no members!
$getQuery = "SELECT `member`.`userID` FROM `member` WHERE `member`.`classID` = ?"; 
$getStmt = $db_connect->prepare($getQuery);
$getStmt->bind_param("i", $class);
$getStmt->execute();
$users = $getStmt->get_result();


//Trim userID's of results that already exist
$trimQuery = "SELECT * FROM `result` WHERE `result`.`testID` = ? AND `result`.`userID` = ?";
$trimStmt = $db_connect->prepare($trimQuery);

$trim = [];
while ($user = $users->fetch_assoc()) { //Trimming doesn't work correctly and can cause duplicate entries in some cases, please fix
    $trimStmt->bind_param("ii", $test, $user);
    $trimStmt->execute();
    $trimResult = $trimStmt->get_result();
    if ($trimResult->num_rows === 0) {
        $trim[] = $user['userID'];
    }
}

//Free up unneeded memory
$users->free_result();
$trimResult->free_result();

//Create results from all userID's according to the test
$query = "INSERT INTO `result` (`resultID`, `testID`, `userID`, `completionDate`, `questionTotal`, `questionCurrent`, `questionCorrect`, `points`) VALUES (NULL, ?, ?, NULL, ?, NULL, NULL, NULL)";
$stmt = $db_connect->prepare($query);

$count = 0;

foreach ($trim as $member) {
    $stmt->bind_param("iii", $test, $member, $total);
    if ($stmt->execute()) {
        $count = $count + 1;
    }
}

die($count . " students have been assigned to this test succcessfully!")


?>