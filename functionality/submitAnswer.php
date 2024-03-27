<?php
//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");
@session_start();

//Check fields exist / check current question does not exist test total
if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] > $_SESSION['testTotal']) {
    die(false);
}

//Set variables
$questionID = $db_connect->real_escape_string($_POST['questionID']);
$resultID = $db_connect->real_escape_string($_POST['resultID']);
$choice = $db_connect->real_escape_string($_POST['choice']);

//Check authentication
resultCheck($db_connect, $resultID, $_SESSION['userID']);

//Validation check
$query = "CALL getPosition(?)";
$run = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

if($run['position'] >= $_SESSION['testTotal']) {
    error_log("Question position is invalid for this test.");
    die(false);
} else if ($run['position'] + 1 == $_SESSION['testTotal']) {
    $query = "CALL endTest(?)";
    $db_connect->execute_query($query, [$resultID]);
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