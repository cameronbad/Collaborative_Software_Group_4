<?php

include_once("../includes/_connect.php");

//Checks if the data is grabbed properly
if(!isset($_POST['classID'])){
    die("Error please try again.");
}

$classID = $db_connect->real_escape_string($_POST["classID"]); //Gets id from button value

$stmt = $db_connect->prepare("CALL deleteClass(?)");
$stmt->bind_param("i", $classID);
$stmt->execute();

if ($stmt->affected_rows > 0) {//Checks if the query worked
    echo "Approved";
} else {
    echo "Error: " . $db_connect->error;
}

$stmt->close();
$db_connect->close();


?>