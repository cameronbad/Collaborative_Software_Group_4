<?php
//Add authentication and validation | check question length
session_start();
if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] > $_SESSION['testTotal']) {
    die(false);
}

require_once("../includes/_connect.php");

//Set variables
$questionID = $_POST['questionID'];
$resultID = $_POST['resultID'];
$choice = $_POST['choice'];

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