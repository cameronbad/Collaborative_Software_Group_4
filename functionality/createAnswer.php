<?php
//Add authentication

require_once("../includes/_connect.php");

//Set variables
$questionID = $_GET['questionID'];
$resultID = $_GET['resultID'];
$position = $_GET['position'];


//Need questionID, resultID, questionPosition
$query = "CALL createAnswer(?, ?, ?)";

//Runs query with parameters
if($db_connect->execute_query($query, [$questionID, $resultID, $position])) {
    die("New answer generated");
}
else {
    die("Error: Query failed to execute.");
}

?>