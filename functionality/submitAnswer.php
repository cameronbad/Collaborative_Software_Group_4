<?php
//Add authentication and validation | check question length

require_once("../includes/_connect.php");

//Set variables
$questionID = $_POST['questionID'];
$resultID = $_POST['resultID'];
$choice = $_POST['choice'];

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


if(isset($answer)) {
    die($choice . "|" . $answer['correctAnswer']);
}
else {
    die(false);
}

?>