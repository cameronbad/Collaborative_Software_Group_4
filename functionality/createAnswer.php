<?php
//Add authentication and validation | check question length
@session_start();
if ($_SESSION['accessLevel'] == 1) {
    //Auth passed
} else if ($_SESSION['accessLevel'] == 2) {
    //Auth failed, teacher
    header("Location: ../studentDisplay");
    die();
} else if ($_SESSION['accessLevel'] == 3) {
    //Auth failed, admin
    header("Location: ../adminDashboard");
    die();
} else {
    //Not logged in
    header("Location: ../");
    die();
}

if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] >= $_SESSION['testTotal']) {
    die(false);
}

$resultID = $_GET['resultID'];

//Check if the session user is the same as the user assigned to this result.
$query = "CALL checkUser(?)";
$checkUser = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

if ($checkUser['userID'] == $_SESSION['userID']) {
    //Auth passed
} else {
    //Not the correct user/attempted data manipulation
    header("Location: ./testDashboard");
    die();
}

require_once("../includes/_connect.php");

//Set variables
$questionID = $_GET['questionID'];
$position = $_GET['position'];

//Need questionID, resultID, questionPosition
$query = "CALL createAnswer(?, ?, ?)";

//Runs query with parameters
if($db_connect->execute_query($query, [$questionID, $resultID, $position])) {
    $_SESSION['testCurrent'] = $_SESSION['testCurrent']++;
    die($questionID);
}
else {
    die(false);
}

?>