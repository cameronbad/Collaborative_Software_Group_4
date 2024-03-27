<?php

include_once("../includes/_connect.php");

$className = $db_connect->real_escape_string($_POST["classNameInput"]); //Grabs data from modal form
$courseID = $db_connect->real_escape_string($_POST["classCourseName"]);

$stmt = $db_connect->prepare("CALL createClass(?, ?)"); //prepares the statement
$stmt->bind_param("si", $className, $courseID); //binds the parameters
$stmt->execute();

if ($stmt->affected_rows > 0) {//Checks if the query worked
    echo "Class Created";
} else {
    echo "Error: " . $db_connect->error;
}

$stmt->close();
$db_connect->close();


?>