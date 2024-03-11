<?php
//Add authentication and validation | check question length
session_start();
if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] >= $_SESSION['testTotal']) {
    die(false);
}


require_once("../includes/_connect.php");

//Set variables
$questionID = $_GET['questionID'];
$resultID = $_GET['resultID'];
$position = $_GET['position'];
$_SESSION['testCurrent'] = $_SESSION['testCurrent']++;

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