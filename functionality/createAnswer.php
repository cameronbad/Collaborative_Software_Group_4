<?php
//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");
@session_start();

//Check fields exist / check current question does not exist test total
if (!isset($_SESSION['testCurrent']) || !isset($_SESSION['testTotal']) || $_SESSION['testCurrent'] >= $_SESSION['testTotal']) {
    die(false);
}

//Set variable
$resultID = $db_connect->real_escape_string($_GET['resultID']);

//Check authentication
resultCheck($db_connect, $resultID, $_SEESION['userID']);

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