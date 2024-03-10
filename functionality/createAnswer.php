<?php
//Add authentication and validation | check question length

require_once("../includes/_connect.php");

//Set variables
$questionID = $_GET['questionID'];
$resultID = $_GET['resultID'];
$position = $_GET['position'];


//Need questionID, resultID, questionPosition
$query = "CALL createAnswer(?, ?, ?)";

//Runs query with parameters
if($db_connect->execute_query($query, [$questionID, $resultID, $position])) {
    die($questionID);
}
else {
    die(false);
}

?>