<?php
//User auth here

if (!isset($_POST['classSelect']) ||
    !isset($_POST['aTestID'])
) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$class = mysqli_real_escape_string($db_connect, $_POST['classSelect']);
$test = mysqli_real_escape_string($db_connect, $_POST['aTestID']);

//Get questionTotal
$totalQuery = "SELECT `test`.`questionAmount` FROM `test` WHERE `test`.`testID` = ?"; 
$totalStmt = mysqli_prepare($db_connect, $totalQuery);
mysqli_stmt_bind_param($totalStmt, "i", $test);
mysqli_stmt_execute($totalStmt);
$totalArray = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt));
$total = $totalArray['questionAmount'];

//Get userID's of `class`, `member`             //Add error checking for a class with no members!
$getQuery = "SELECT `member`.`userID` FROM `member` WHERE `member`.`classID` = ?"; 
$getStmt = mysqli_prepare($db_connect, $getQuery);
mysqli_stmt_bind_param($getStmt, "i", $class);
mysqli_stmt_execute($getStmt);
$users = mysqli_stmt_get_result($getStmt);


//Trim userID's of results that already exist
$trimQuery = "SELECT * FROM `result` WHERE `result`.`testID` = ? AND `result`.`userID` = ?";
$trimStmt = mysqli_prepare($db_connect, $trimQuery);

$trim = [];

while ($user = mysqli_fetch_assoc($users)) { //Trimming doesn't work correctly and can cause duplicate entries in some cases, please fix
    mysqli_stmt_bind_param($trimStmt, "ii", $test, $user);
    mysqli_stmt_execute($trimStmt);
    $trimResult = mysqli_stmt_get_result($trimStmt);
    if (mysqli_num_rows($trimResult) === 0) {
        $trim[] = $user['userID'];
    }
}

//Free up unneeded memory
mysqli_free_result($users);
mysqli_free_result($trimResult);

//Create results from all userID's according to the test
$query = "INSERT INTO `result` (`resultID`, `testID`, `userID`, `completionDate`, `questionTotal`, `questionCurrent`, `questionCorrect`, `points`) VALUES (NULL, ?, ?, NULL, ?, NULL, NULL, NULL)";
$stmt = mysqli_prepare($db_connect, $query);

$count = 0;

foreach ($trim as $member) {
    mysqli_stmt_bind_param($stmt, "iii", $test, $member, $total);
    if (mysqli_stmt_execute($stmt)) {
        $count = $count + 1;
    }
}

die($count . " students have been assigned to this test succcessfully!")


?>