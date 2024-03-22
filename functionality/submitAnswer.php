<?php
//Add authentication and validation | check question length
session_start();
if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] > $_SESSION['testTotal']) {
    die(false);
}

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

require_once("../includes/_connect.php");

//Set variables
$questionID = $_POST['questionID'];
$resultID = $_POST['resultID'];
$choice = $_POST['choice'];

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

//Validation check
$query = "CALL getPosition(?)";
$run = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

if($run['position'] >= $_SESSION['testTotal']) {
    error_log("Question position is invalid for this test.");
    die(false);
}

//Need questionID, resultID, questionPosition
$query = "CALL submitAnswer(?, ?, ?)";

//Runs query with parameters
$checkSubmit = $db_connect->execute_query($query, [$questionID, $resultID, $choice]);

if(!$checkSubmit) {
    die("Error: Answer submission failed.");
}

//Get correct answer
$query = "CALL getCorrectAnswer(?)";
$answer = $db_connect->execute_query($query, [$questionID])->fetch_assoc();


if($answer) {
    die(strval($answer['correctAnswer']));
}
else {
    error_log("Answer submitted but failed to get correct answer from database.");
    die(false);
}

?>